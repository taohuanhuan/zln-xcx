<template>
	<view class="page">

		<!-- ===== 提醒信息卡片 ===== -->
		<view class="card">
			<view class="row" style="border-top:1px solid #f0f0f0;">
				<text class="row-label">药品名称</text>
				<view class="row-input">
					<u-input v-model="form.drugName" type="number" placeholder="请输入药品名称" input-align="right"
						border="none" clearable class="input" />
				</view>
			</view>
			<!-- 开始日期 -->
			<view class="row clickable" @click="showDatePicker = true">
				<text class="row-label">开始日期</text>
				<text class="row-value">{{ startDateLabel }}</text>
				<text class="row-arrow">›</text>
			</view>
			<u-datetime-picker v-model="form.startDateTs" :show="showDatePicker" mode="date"
				@confirm="showDatePicker = false" @cancel="showDatePicker = false" />

			<!-- 疗程天数 -->
			<view class="row">
				<text class="row-label">疗程天数</text>
				<view class="row-input">
					<u-input v-model="form.duration" type="number" placeholder="请输入疗程天数" input-align="right"
						border="none" clearable class="input" />
					<text class="unit-label">天</text>
				</view>


			</view>

			<!-- 用药方案（联动） -->
			<view class="row clickable" @click="showPlanPicker = true">
				<text class="row-label">用药方案</text>
				<text class="row-value">{{ planLabel }}</text>
				<text class="row-arrow">›</text>
			</view>
			<u-picker :show="showPlanPicker" :columns="planColumns" @cancel="showPlanPicker = false"
				@confirm="onPlanConfirm" />

			<!-- 用药时间 -->
			<view class="row" style="border-bottom:none">
				<text class="row-label">用药时间</text>
			</view>
			<view class="time-buttons">
				<view v-for="(ts, i) in form.timeTsList" :key="i" size="small" type="primary" plain class="time-button"
					@click="openTimePicker(i)">
					{{ formatTime(ts) }}
					<u-icon name="edit-pen" size="24" />
				</view>
			</view>
			<u-datetime-picker v-model="currentTimeTs" :show="showTimePicker" mode="time" @confirm="onTimeConfirm"
				@cancel="showTimePicker = false" />

			<!-- 每次用量（联动 Picker） -->
			<view class="row clickable" @click="showDosagePicker = true" style="border-top:1px solid #f0f0f0;">
				<text class="row-label">每次用量</text>
				<text class="row-value">
					{{ form.dosage || '请选择用量' }}
				</text>
				<text class="row-arrow">›</text>
			</view>
			<u-picker :show="showDosagePicker" :columns="[dosageAmountColumns, unitColumns]"
				@cancel="showDosagePicker = false" @confirm="onDosageConfirm" />


		</view>

		<!-- ===== 说明文字 ===== -->
		<view class="note">
			* 为向您提供用药提醒功能，以及在根据您的需求向您推送提醒通知时显示准确的用药信息，需要您在设置提醒时选择适应症，并确认使用方式及开始日期等用药信息；本平台也将采取严格措施保护您录入及确认的信息。<br />
			* 本平台用药提醒仅供您自行记录使用，不反映您真实用药情况，不作为具有医生证明的医疗记录。
		</view>

		<!-- ===== 底部保存按钮 ===== -->
		<view class="btn-wrap">
			<u-button block color="#BB4FE1" type="primary" @click="save">
				保存
			</u-button>
		</view>

	</view>
</template>

<script>
	import {
		postReminder,
		pushSchedule,
		reminderCreate
	} from '@/config/api'

	export default {
		data() {
			return {
				form: {
					drugName: '',
					startDateTs: Date.now(),
					duration: '',
					planPeriod: '每天',
					planTimes: 1,
					timeTsList: [{
						value: '8:00'
					}],
					dosage: '',

				},
				showDosagePicker: false,
				// 第一列：数量 1～20
				dosageAmountColumns: Array.from({
					length: 10
				}, (_, i) => `${i + 1}`),
				// 第二列：单位列表
				unitColumns: ['片', '粒', 'ml', 'mg', '瓶', '支'],

				showDatePicker: false,
				showPlanPicker: false,
				showTimePicker: false,
				params: '',
				planColumns: [
					['每天', '每周'],
					Array.from({
						length: 10
					}, (_, i) => `${i+1}次`)
				],
				editTimeIndex: 0,
				currentTimeTs: Date.now()
			}
		},
		computed: {
			startDateLabel() {
				const d = new Date(this.form.startDateTs)
				const M = String(d.getMonth() + 1).padStart(2, '0')
				const D = String(d.getDate()).padStart(2, '0')
				return `${d.getFullYear()}-${M}-${D}`
			},
			planLabel() {
				return `${this.form.planPeriod}${this.form.planTimes}次`
			}
		},
		watch: {
			'form.planTimes'(newVal) {
				const list = this.form.timeTsList
				const diff = newVal - list.length
				if (diff > 0) {
					// 新增时，都默认显示 "08:00"
					for (let i = 0; i < diff; i++) {
						list.push({
							value: '08:00'
						});
					}
				} else if (diff < 0) {
					// 减少时，截取前 newVal 项
					this.form.timeTsList = list.slice(0, newVal)
				}
			}
		},

		methods: {

			async pushSchedule() {
				const p = {
					openid: "TEST_OPENID",
					template_id: "TEMPLATE_ID",
					page: "pages/index/index",
					data: {
						"foo": "bar"
					},
					send_time: "2025-05-23 11:22:00"
				}
				const res = await pushSchedule(p)
				console.log(JSON.stringify(res))
			},
			async reminderCreate() {
				// 1. 从原本 this.params 拿到你需要的字段
				const {
					startDateTs, // 毫秒时间戳
					drugName,
					duration,
					timeList, // ["08:00","12:00",...]
					dosage
				} = this.params;

				// 2. 计算后端要的 startDate 字符串 YYYY-MM-DD
				const d = new Date(startDateTs);
				const year = d.getFullYear();
				const month = String(d.getMonth() + 1).padStart(2, '0');
				const day = String(d.getDate()).padStart(2, '0');
				const startDate = `${year}-${month}-${day}`;

				// 3. 组织请求体
				const payload = {
					drugName, // 药品名称
					dosage, // 每次用量
					startDate, // 开始日期（YYYY-MM-DD）
					duration, // 疗程天数
					timeList, // 用药时间点 ["08:00","12:00",...]
					template_id: 'mYAqApDfavc8Qi2ktE1f1p-4Xjp2C_fe7hKeiRknZlA',
					page: 'pages/reminder/detail'
				};

				// 4. 调用后端接口
				try {
					const res = await reminderCreate(payload);
					console.log('创建结果：', res);
					if (res.code === 1) {
						uni.showToast({
							title: '用药提醒创建成功'
						});
					} else {
						uni.showToast({
							title: res.msg || '创建失败',
							icon: 'none'
						});
					}
				} catch (err) {
					console.error('调用失败', err);
					uni.showToast({
						title: '网络错误',
						icon: 'none'
					});
				}
			},
			subscribeRemind() {
				const that = this
				wx.requestSubscribeMessage({
					tmplIds: ['mYAqApDfavc8Qi2ktE1f1p-4Xjp2C_fe7hKeiRknZlA'], // 你申请的模板列表
					success(res) {
						that.reminderCreate();

						// 用户同意后返回 { TEMPLATE_ID_1: 'accept', ... }
						if (res['mYAqApDfavc8Qi2ktE1f1p-4Xjp2C_fe7hKeiRknZlA'] === 'accept') {
							// 可把标记保存到本地或发给后端，下次发送用
							wx.showToast({
								title: '订阅成功，稍后会提醒你',
								icon: 'success'
							});
						} else {
							wx.showModal({
								title: '授权失败',
								content: '你未同意订阅，无法收到提醒',
								showCancel: false
							});
						}
					},
					fail(err) {
						console.error('订阅请求失败：', err);
					}
				});
			},
			onDosageConfirm(e) {
				const [amt, unit] = e.value
				this.form.dosage = `${amt}${unit}`
				this.showDosagePicker = false
			},
			onPlanConfirm(e) {
				const [period, timesText] = e.value
				this.form.planPeriod = period
				this.form.planTimes = parseInt(timesText)
				this.showPlanPicker = false
			},
			openTimePicker(i) {
				this.editTimeIndex = i
				this.currentTimeTs = this.form.timeTsList[i]
				this.showTimePicker = true
			},
			onTimeConfirm(ts) {
				const timestamp = (ts && ts.detail && ts.detail.value) || ts
				this.$set(this.form.timeTsList, this.editTimeIndex, timestamp)
				this.showTimePicker = false
			},
			formatTime(ts) {
				console.log("日历" + JSON.stringify(ts))
				return ts.value
			},
			async save() {
				const {
					startDateTs,
					drugName,
					duration,
					planPeriod,
					planTimes,
					timeTsList,
					dosage
				} = this.form;

				// 校验必填项
				if (!drugName || !drugName) {
					return uni.showToast({
						title: '请填写药品名称',
						icon: 'none'
					});
				}


				// 提取 timeList：直接拿 value 字符串数组
				const timeList = timeTsList.map(item => item.value);

				this.params = {
					startDateTs, // 毫秒时间戳
					drugName,
					duration: parseInt(duration), // 疗程天数
					planPeriod, // '每天' 或 '每周'
					planTimes: parseInt(planTimes), // 用药次数
					timeList, // ['08:00','12:00',...]
					dosage // 每次用量
				};



				try {
					uni.showLoading({
						title: '保存中...'
					});
					const res = await postReminder(this.params);
					if (res.code === 1) {
						this.subscribeRemind();
						uni.showToast({
							title: '保存成功'
						});
						uni.navigateBack();
					} else {
						uni.showToast({
							title: res.msg || '保存失败',
							icon: 'none'
						});
					}
				} catch (err) {
					console.error(err);
					uni.showToast({
						title: '网络或服务器错误',
						icon: 'none'
					});
				} finally {
					uni.hideLoading();
				}
			}
		}
	}
</script>

<style scoped>
	.page {
		display: flex;
		flex-direction: column;
		min-height: 100vh;
		background: #f5f5f5;
	}

	.card {
		margin: 20rpx;
		background: #fff;
		border-radius: 12rpx;
		overflow: hidden;
	}

	.row {
		display: flex;
		align-items: center;
		padding: 28rpx 30rpx;
		border-bottom: 1px solid #f0f0f0;
	}

	.row:last-child {
		border-bottom-width: 0;
	}

	.row-label {
		font-size: 30rpx;
		color: #333;
	}

	.row-value {
		flex: 1;
		text-align: right;
		font-size: 30rpx;
		color: #888;
	}

	.row-arrow {
		margin-left: 12rpx;
		font-size: 36rpx;
		color: #c0c0c0;
	}

	.row-input {
		flex: 1;
		display: flex;
		justify-content: flex-end;
	}

	.input {
		width: 250rpx;
	}

	.clickable {
		cursor: pointer;
	}

	/* 时间按钮：两行三列 */
	.time-buttons {
		display: flex;
		flex-wrap: wrap;
		gap: 10rpx;
		padding: 0 30rpx;
	}

	.time-button {
		margin-bottom: 20rpx;
		height: 60rpx;
		line-height: 60rpx;
		width: 30%;
		background-color: #F3F7FA;
		color: #4E595F;
		text-align: center;
		display: flex;
		justify-content: center;
	}

	.note {
		padding: 20rpx 30rpx;
		font-size: 22rpx;
		color: #999;
		line-height: 30rpx;
	}

	.btn-wrap {
		margin-top: auto;
		padding: 20rpx 30rpx 30rpx;
		background: #fff;
	}

	/* 如需可加样式 */
	.row-value {
		flex: 1;
		text-align: right;
		font-size: 30rpx;
		color: #888;
	}

	.row-arrow {
		margin-left: 12rpx;
		font-size: 36rpx;
		color: #c0c0c0;
	}
</style>