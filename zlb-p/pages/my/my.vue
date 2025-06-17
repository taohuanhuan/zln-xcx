<template>

	<view class="container" style="width: 690rpx;">
		<view class="profile-container" >
			<image class="profile-avatar" src="../../static/img/it5.png" @click="navigateToDetailso"></image>
			<view class="profile-info">
				<text class="profile-nickname" @click="navigateToDetailso">橘子味汽水</text>
				<text class="profile-id" @click="navigateToDetailso">ID: 165262638890</text>
				<view class="profile-tag">
					<view :class="['tag-left', selectedTag === 'left' ? 'active-tag' : 'inactive-tag']" data-tag="left"
						@tap="toggleTag">
						本人
					</view>
					<view :class="['tag-right', selectedTag === 'right' ? 'active-tag' : 'inactive-tag']"
						data-tag="right" @tap="toggleTag">
						代诊
					</view>
				</view>
			</view>
		</view>
		<view class="coupon-row">
			<view class="coupon-item" v-for="(item, index) in couponitems" :key="index" @click="navigateToPage1(index)">
				<text class="coupon-value">{{ item.value }}</text>
				<text class="coupon-text">{{ item.text }}</text>
			</view>
		</view>
<!-- navigateToUrl="/pages/reservation/appointment" -->
		<custom-component title="我的预约" :show-description="true" description="查看全部" icon-name="arrow-right"
			 class="m-b-20">
			<template v-slot:bottom-content>
				<view class="appointment-row">
					<view class="appointment-item" v-for="(item, index) in appointmentitems" :key="index"
						@click="navigateToAppointment(index)">
						<image :src="'../../static/img/yy' + (index + 1) + '.png'" class="appointment-image"></image>
						<text class="appointment-text">{{ item }}</text>
					</view>
				</view>
			</template>
		</custom-component>

		<view class="item-list">
			<view class="item" style="position: relative;" v-for="(item, index) in items" :key="index" @click="navigateToPage(index)">
				<img :src="'../../static/img/wd' + (index + 1) + '.png'" alt="" class="item-icon">
				<span class="item-text">{{ item.text }}</span>
				<img src="../../static/img/arrow-right.png" alt="" class="arrow-icon">
				<template v-if="index===4">
					<button open-type="contact"
					style="background-color: red;position: absolute;top: 0;z-index: 1;width: 100%;height: 100%;opacity: 0;"> </button>
				</template>
				
			</view>

		</view>
		
		<view class="item-list" style="margin-bottom: 0rpx;">
		
			<view class="item" @click="switchUser('/guanlishi/index/index')">
				<img :src="'../../static/img/wd6.png'" alt="" class="item-icon">
				<span class="item-text">切换角色</span>
				<img src="../../static/img/arrow-right.png" alt="" class="arrow-icon">
				
			</view>
		</view>
	</view>

</template>

<script>
	export default {
		name: 'CustomList',
		data() {
			return {
				selectedTag: 'left', // 初始状态为 'left'，即“本人”选中

				couponitems: [{
						value: '10',
						text: '我的优惠券',
						path: '/pages/my/youhuiquan'
					},
					{
						value: '879',
						text: '我的积分',
						path: '/pages/my/jifen'

					},
					{
						value: '634',
						text: '已购活动',
						path: '/pages/my/yigouhuodong'

					}
				],
				appointmentitems: ['待支付', '待咨询', '待评价', '已完成'],
				appointmentPaths: [
					'/pages/reservation/appointment_pending_payment_detail',
					'/pages/reservation/appointment_pending_consultation',
					// '/pages/reservation/appointment_in_progress_detail',
					'/pages/reservation/appointment_pending_review_detail',
					'/pages/reservation/appointment_completed_detail'
				],

				items: [{
						text: '我的课程',
						icon: 'wd1',
						path: '/pages/kecheng/course'
					},
					{
						text: '邀请好友',
						icon: 'wd2',
						path: '/pages/yaoqing/index'
					},
					{
						text: '常见问题',
						icon: 'wd3',
						path: '/pages/my/common_questions'
					},
					{
						text: '投诉/建议',
						icon: 'wd4',
						path: '/pages/yaoqing/tousu'
					},
					{
						text: '在线客服',
						icon: 'wd5',
						path: '/pages/my/online_customer_service'
					}
				]
			}
		},
		methods: {
			navigateToPage(index) {
				const url = this.items[index].path;
				if (url) {
					uni.navigateTo({
						url
					});
				}
			},
			navigateToPage1(index) {
				const url = this.couponitems[index].path;
				
				if (url) {
					uni.navigateTo({
						url
					});
				}
			},
			navigateToAppointment(index) {
				let url = '/pages/reservation/appointment';//this.appointmentPaths[index];
				url = url+'?status='+(index+1)
				if (url) {
					uni.navigateTo({
						url
					});
				}
			},
			navigateToDetailso() {
				uni.navigateTo({
					url: '/pages/my/gerenxinxi'
				});
			},
			switchUser(url) {
				uni.setStorageSync('role', 'information')
				uni.navigateTo({
					url
				});
			},
			toggleTag(e) {
				const selected = e.currentTarget.dataset.tag;
				this.selectedTag=selected
			},
		}
	}
</script>

<style scoped>
	.container {
		background: linear-gradient(to bottom, #EEB3FA 0%, #f6f6f6 30%);
		background-repeat: no-repeat;
		/* 确保背景不重复 */
		background-attachment: fixed;
		/* 背景固定，不随滚动条滚动 */
		background-size: cover;
		/* 背景覆盖整个页面，适应所有尺寸 */
		min-height: 100vh;

		/* 确保至少覆盖整个视口高度 */
		width: 690rpx;
		margin: 0rpx -30rpx;
		padding: 100rpx 30rpx 30rpx 30rpx;
	}


	.profile-container {
		display: flex;
		align-items: center;
		padding: 50rpx 0 0 0;
	}

	.profile-avatar {
		width: 140rpx;
		height: 140rpx;
		border-radius: 50%;
		border: 4rpx solid white;
		margin-right: 20rpx;
	}

	.profile-info {
		display: flex;
		flex-direction: column;
	}

	.profile-nickname {
		font-weight: bold;
		font-size: 36rpx;
		color: #242424;
		margin-bottom: 16rpx;
	}

	.profile-id {
		font-weight: 400;
		font-size: 24rpx;
		color: #7C7C7C;
		margin-bottom: 16rpx;
	}

	.profile-tag {
		display: flex;
		width: 136rpx;
		height: 40rpx;
		font-size: 22rpx;
		line-height: 38rpx;
	}

	.tag-left,
	.tag-right {
		display: flex;
		justify-content: center;
		align-items: center;
		width: 68rpx;
		border-radius: 4rpx;
		cursor: pointer;
		line-height: 38rpx;		
	}

	.tag-left {
		border-radius: 4rpx 0 0 4rpx;
	}

	.tag-right {
		border-radius: 0 4rpx 4rpx 0;
	}

	.active-tag {
		background-color: #6575AB;
		color: white;
	}

	.inactive-tag {
		background-color: #ffffff;
		color: #6575AB;
		border: 1rpx solid #6575AB;
	}

	.coupon-row {
		display: flex;
		justify-content: space-around;
		/* 元素间均匀分布，周围留有空间 */
		align-items: center;
		flex-wrap: wrap;
		/* 允许元素根据需要换行 */
		margin: 28rpx 0;
	}

	.coupon-item {
		display: flex;
		flex-direction: column;
		/* 文字垂直堆叠 */
		align-items: center;
		/* 水平居中对齐 */
	}

	.coupon-value {
		font-weight: bold;
		font-size: 40rpx;
		color: #091627;
		margin-bottom: 12rpx;
		/* 文字间距 */
	}

	.coupon-text {
		font-weight: 400;
		font-size: 24rpx;
		color: #051628;
	}

	.appointment-row {
		display: flex;
		justify-content: space-around;
		/* 每个元素平均分布，周围留有空间 */
		align-items: center;
		flex-wrap: wrap;
		/* 允许元素根据需要换行 */
		padding-bottom: 26rpx;
		font-size: 28rpx;
	}

	.appointment-item {
		display: flex;
		flex-direction: column;
		/* 图片和文字垂直堆叠 */
		align-items: center;
		/* 水平居中对齐 */
		margin-bottom: 12rpx;
		/* 图片与文字间距 */
	}

	.appointment-image {
		width: 60rpx;
		/* 根据实际需要调整 */
		height: 60rpx;
		/* 根据实际需要调整 */
	}

	.appointment-text {
		font-size: 24rpx;
		/* 根据实际需要调整 */
		color: #242424;
		/* 文字颜色 */
	}

	.item-list {
		/* 		width: 100%; */
		padding: 20rpx;
		border-radius: 24rpx;
		background-color: #ffffff;
		font-size: 28rpx;
		margin-top: 30rpx;

		/* 设置背景颜色为白色 */
	}

	.item {
		display: flex;
		align-items: center;
		padding: 20rpx;
		margin-bottom: 10rpx;
		/* 根据需要调整 */
		border-radius: 10px;
		/* 根据需要调整 */
		background-color: #ffffff;
		/* 每个条目的背景色设置为白色 */
	}

	.item-icon {
		width: 60rpx;
		height: 60rpx;
		margin-right: 20rpx;
	}

	.item-text {
		flex-grow: 1;
		font-size: 30rpx;
		color: #242424;
		/* 文字颜色 */
	}

	.arrow-icon {
		width: 40rpx;
		height: 30rpx;
	}
</style>