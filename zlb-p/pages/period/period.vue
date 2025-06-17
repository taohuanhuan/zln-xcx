```vue
<template>
	<view class="period-container">
		<!-- 星期栏（固定） -->
		<view class="week-days">
			<view v-for="(d, i) in weekDays" :key="i" class="week-day">{{ d }}</view>
		</view>

		<!-- 月历（滚动） -->
		<scroll-view class="calendar-scroll" scroll-y>
			<view v-for="(month, mIdx) in months" :key="mIdx" class="month-block">
				<view class="month-header">
					{{ month.year }}年{{ month.month }}月
				</view>

				<view class="calendar">
					<view v-for="(cell, cIdx) in month.days" :key="cIdx" class="calendar-cell" :class="{
              blank     : !cell.day,
              selected  : isSelected(cell.date),
              'is-start': isStart(cell.date),
              'is-end'  : isEnd(cell.date),
              'in-range': inRange(cell.date)
            }" @click="onDateClick(cell.date)">
						<text v-if="cell.day">{{ cell.day }}</text>
					</view>
				</view>
			</view>
		</scroll-view>

		<!-- 操作按钮 -->
		<view class="actions">
			<u-button type="primary" color="#BB4FE1" :disabled="!selectedDate" @click="markPeriodStart">经期开始</u-button>
			<u-button type="primary" color="#BB4FE1" :disabled="!selectedDate" @click="markPeriodEnd">经期结束</u-button>
		</view>

		<view class="tip">
			若需取消已标记，在经期区间内点任意日期作为新的开始
		</view>
	</view>
</template>

<script>
	import {
		MenstrualList,
		MenstrualSave
	} from '@/config/api'

	export default {
		data() {
			return {
				weekDays: ['日', '一', '二', '三', '四', '五', '六'],
				months: [],
				selectedDate: null,
				startDates: [], // 记录所有开始日期
				endDates: [], // 记录所有结束日期
				records: [] // 存后端原始记录
			}
		},
		created() {
			this.buildMonths(12) // 生成当前月起连续12个月
			this.list() // 拉取并渲染历史记录
		},
		methods: {
			// 拉取历史记录并填充 startDates/endDates
			async list() {
				try {
					const res = await MenstrualList()
					this.records = res.data || []
					this.startDates = []
					this.endDates = []
					this.records.forEach(r => {
						this.startDates.push(r.start_date)
						if (r.end_date) {
							this.endDates.push(r.end_date)
						}
					})
				} catch (e) {
					uni.showToast({
						title: e.msg || '加载失败',
						icon: 'none'
					})
				}
			},

			// 单次保存 start 或 end
			async save(type, date) {
				if (!date) return
				try {
					await MenstrualSave({
						type,
						date
					})
					uni.showToast({
						title: '保存成功',
						icon: 'success'
					})
					this.list()
				} catch (e) {
					uni.showToast({
						title: e.msg || '保存失败',
						icon: 'none'
					})
				}
			},

			// 点击日期
			onDateClick(date) {
				if (!date) return
				this.selectedDate = date
			},

			// 标记开始
			markPeriodStart() {
				if (!this.selectedDate) {
					uni.showToast({
						title: '请先选择日期',
						icon: 'none'
					})
					return
				}
				this.save('start', this.selectedDate)
			},
			// 标记结束
			markPeriodEnd() {
				if (!this.selectedDate) {
					uni.showToast({
						title: '请先选择日期',
						icon: 'none'
					})
					return
				}
				this.save('end', this.selectedDate)
			},

			// 生成月份
			buildMonths(n) {
				const now = new Date()
				for (let i = 0; i < n; i++) {
					const dt = new Date(now.getFullYear(), now.getMonth() + i, 1)
					this.months.push({
						year: dt.getFullYear(),
						month: dt.getMonth() + 1,
						days: this.buildDays(dt.getFullYear(), dt.getMonth() + 1)
					})
				}
			},
			// 生成某月日格含空位
			buildDays(year, month) {
				const first = new Date(year, month - 1, 1).getDay()
				const total = new Date(year, month, 0).getDate()
				const arr = []
				for (let i = 0; i < first; i++) {
					arr.push({
						day: '',
						date: ''
					})
				}
				for (let d = 1; d <= total; d++) {
					const mm = String(month).padStart(2, '0')
					const dd = String(d).padStart(2, '0')
					arr.push({
						day: d,
						date: `${year}-${mm}-${dd}`
					})
				}
				return arr
			},

			// 渲染状态判断
			isSelected(d) {
				return d && this.selectedDate === d
			},
			isStart(d) {
				return d && this.startDates.includes(d)
			},
			isEnd(d) {
				return d && this.endDates.includes(d)
			},
			inRange(d) {
				return this.startDates.some((s, i) => {
					const e = this.endDates[i]
					return e && d > s && d < e
				})
			}
		}
	}
</script>

```css
<style scoped>
	:root {
		--primary-color: #BB4FE1;
	}

	.period-container {
		padding: 32rpx;
		background-color: #ffffff;
	}

	/* 星期栏 */
	.week-days {
		display: flex;
		margin-bottom: 16rpx;
	}

	.week-day {
		flex: 1;
		text-align: center;
		font-size: 26rpx;
		color: #666;
	}

	/* 滚动高度 */
	.calendar-scroll {
		height: 600rpx;
		background-color: #f7f7f7;
		border-radius: 16rpx;
		padding:20rpx 10rpx;
		width: 666rpx;
	}

	/* 月块标题 */
	.month-block {
		margin-bottom: 48rpx;
	}

	.month-header {
		font-size: 34rpx;
		text-align: center;
		margin-bottom: 16rpx;
	}

	/* 网格：CSS Grid */
	.calendar {
		display: grid;
		grid-template-columns: repeat(7, 1fr);
		gap: 8rpx;
		/* 行列间距 */
	}

	/* 基础格子 */
	.calendar-cell {
		aspect-ratio: 1;
		display: flex;
		justify-content: center;
		align-items: center;
		font-size: 28rpx;
		border-radius: 50%;
		background: transparent;
		border: none;
		box-sizing: border-box;
	}

	/* 空白格保持透明 */
	.calendar-cell.blank {
		background: transparent;
		border: none;
	}

	/* 统一圆形紫色实线框：选中、开始、结束 */
	.calendar-cell.selected,
	.calendar-cell.is-start,
	.calendar-cell.is-end {
		border: 2rpx solid var(--primary-color);
		color: var(--primary-color);
	}

	/* 经期区间淡紫背景 */
	.calendar-cell.in-range {
		background: rgba(187, 79, 225, 0.15);
		color: var(--primary-color);
	}

	/* 按钮区 & 提示 */
	.actions {
		margin: 24rpx 0 8rpx;
		display: flex;
		justify-content: space-around;
		gap: 20rpx;
	}

	.tip {
		text-align: center;
		font-size: 22rpx;
		color: #999;
		margin: 20rpx 0;
	}
</style>
```