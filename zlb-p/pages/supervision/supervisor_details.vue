<template>
	<view style="width: 690rpx;">

		<view class="ctop">
			<image style="height: auto;margin: 0 0 20rpx 0; width:630rpx;" mode="widthFix"
				src="../../static/img/kct.png">
			</image>
			<view class="user-container" style="padding: 0;width: 100%;">
				<image class="user-avatar" src="../../static/img/it6.png" style="width: 90rpx;height: 90rpx;min-width: 90rpx;"
					alt="用户头像"></image>
				<view class="user-info" style="width: 100%;">
					<view class="counselor-name-row">
						<view class="counselor-name">宣援翰</view>
						<view>个人成长</view>
					</view>

					<view class="" style="display: flex;">
						<view style="margin-right: 20rpx;">
							<u-tag :borderColor="'#F19436'" :bg-color="'#FFEEDE'" :color="'#F19436'" class="m-l-10"
								text="新课首发"></u-tag>
						</view>

						<u-tag :borderColor="'#F19436'" :bg-color="'#FFEEDE'" :color="'#F19436'" class="m-l-10"
							text="收录5年">
						</u-tag>
					</view>
				</view>
			</view>
			
			<view class="counselor-detail" style="color: #999999;margin: 20rpx 0;">最早可预约时间：<text
					style="color: #555555;">2024/06/18 14:38</text></view>

			<view class="counselor-stats-row">
				<text class="counselor-stats" style="color: #999999;"><text style="color: #EF851A;">956</text>人咨询 ·
					<text style="color: #EF851A;">96.85%</text>好评</text>
			</view>

			<view class=""
				style="background: #F6F6F6;border-radius: 10rpx; padding: 30rpx;font-size: 28rpx;color: #999999;">
				我是一段咨询师简介的文案占位符，不要以“为别人考虑”做理由，其实丢弃了“舍我其谁”的使命感.我是一段咨询师简介的文案占位符，不要以“为别人考虑”做理由，其实丢弃了“舍我其谁”的使命感
			</view>

			<view class="kycontainer">
				<view class="left-text" @click="gogrjs">个人介绍</view>
				<view class="divider"></view>
				<view class="right-text" @click="gosz">督导设置</view>
				<view class="divider"></view>
				<view class="right-text" @click="gokysj">可约时间</view>
			</view>
		</view>

		<custom-component title="其他用户评价" :show-description="true" description="查看全部" icon-name="arrow-right"
			class="m-b-20" :navigateToUrl="'/pages/platform_intro/feedback'">
			<template v-slot:bottom-content>
				<view class="counselor-item">

					<view class="">

						<view class="user-container">
							<image class="user-avatar" src="../../static/img/it6.png" alt="用户头像"></image>
							<view class="user-info">
								<text class="user-nickname">我是用户昵称</text>
								<text class="user-time">2024.05.05 09:34</text>
							</view>
						</view>

						<view class="user-con">
							再大的愿景都是从小处着手，越大的图越要从小处搞，越小的东西越要从大处着眼
						</view>
						<view class="image-gallery">
							<image v-for="(img, index) in images" :key="index" :src="img.url" class="gallery-image">
							</image>
						</view>
						<view class="line">

						</view>
					</view>

					<view class="">

						<view class="user-container">
							<image class="user-avatar" src="../../static/img/it6.png" alt="用户头像"></image>
							<view class="user-info">
								<text class="user-nickname">我是用户昵称</text>
								<text class="user-time">2024.05.05 09:34</text>
							</view>
						</view>

						<view class="user-con">
							再大的愿景都是从小处着手，越大的图越要从小处搞，越小的东西越要从大处着眼
						</view>
						<view class="image-gallery">
							<image v-for="(img, index) in images" :key="index" :src="img.url" class="gallery-image">
							</image>
						</view>
						<view class="line">

						</view>
					</view>
				</view>
			</template> </custom-component>

		<view class="" style="width: 100%;height: 120rpx;">

		</view>

		<view class="floating-bar">
			<view class="left-section">
				<view class="icon-text">
					<image src="../../static/img/share.png" class="icon" />
					<view style="font-size: 20rpx;">立即分享</view>
					<button open-type="share"
					style="background-color: red;position: absolute;top: 0;z-index: 1;width: 100%;height: 100%;opacity: 0;"> </button>
				</view>
				<view class="icon-text">
					<image src="../../static/img/chat.png" class="icon" />
					<view style="font-size: 20rpx;">在线咨询</view>
					<button open-type="contact"
					style="background-color: red;position: absolute;top: 0;z-index: 1;width: 100%;height: 100%;opacity: 0;"> </button>
				</view>
			</view>
			<view class="" style="text-align: right;">
				<button class="appointment-button" @click="goyy">立即预约</button>
			</view>

		</view>

		<u-popup :show="show" :closeable="true" @close="close" @open="open" position="bottom"
			:close-on-click-overlay="true">
			<view class="time-select-container">
				<view class="time-select-header">
					<text class="time-select-title">可约时间</text>
				</view>
				<u-tabs :list="dates" @change="handleTabChange" sticky class="time-select-tabs" lineColor="#C871E7">

				</u-tabs>

				<view class="time-select-slots">
					<view v-for="(time, index) in times" :key="time.id" :slot="`tab-${index}`" class="">
						<view :class="['time-select-slot', { 'booked': time.booked }]" style="width: 23%;">
							{{ time.label }}
						</view>
					</view>
				</view>

				<u-checkbox-group class="time-select-footer" v-model="checkboxValue1" placement="row"
					@change="checkboxChange">
					<u-checkbox :customStyle="{margin: '8px'}" v-for="(item, index) in checkboxList1" :key="index"
						:label="item.name" :name="item.name" :disabled="item.disabled" style="">
					</u-checkbox>
				</u-checkbox-group>

				<!-- <view class="pay-btn">
					确认
				</view> -->
			</view>
		</u-popup>

	</view>
</template>

<script>
	export default {
		data() {
			return {
				images: [{
						url: '../../static/img/it1.png'
					},
					{
						url: '../../static/img/it2.png'
					},
					{
						url: '../../static/img/it3.png'
					}
				],
				showTimePopup: true,
				show: false,
				activeTab: 0,
				isAvailable: false,
				isUnavailable: false,
				dates: [{
						name: '周一 05.13'
					},
					{
						name: '周二 05.14'
					},
					{
						name: '周三 05.15'
					},
					{
						name: '周四 05.16'
					}
				],

				times: [{
						id: 1,
						label: '12:00',
						booked: false
					},
					{
						id: 2,
						label: '13:00',
						booked: true
					},
					{
						id: 3,
						label: '14:00',
						booked: false
					},
					{
						id: 3,
						label: '14:00',
						booked: false
					},
					{
						id: 3,
						label: '14:00',
						booked: false
					},
					{
						id: 3,
						label: '14:00',
						booked: false
					},
					{
						id: 3,
						label: '14:00',
						booked: false
					},
					{
						id: 3,
						label: '14:00',
						booked: false
					},
					{
						id: 3,
						label: '14:00',
						booked: false
					},
					{
						id: 3,
						label: '14:00',
						booked: false
					},
					{
						id: 3,
						label: '14:00',
						booked: false
					},
					{
						id: 3,
						label: '14:00',
						booked: false
					},
					{
						id: 3,
						label: '14:00',
						booked: false
					}
				],
				checkboxValue1: [],
				// 基本案列数据
				checkboxList1: [{
						name: '可约',
						disabled: false
					},
					{
						name: '不可约',
						disabled: true
					}
				],
			}

		},

		methods: {
			handleTabChange(index) {
				this.activeTab = index;
			},
			close() {
				this.show = false
			},
			gokysj() {
				this.show = true
				console.log("点击时间")
			},
			goyy() {
				wx.navigateTo({
					url: '/pages/reservation/immediate_reservation'
				});
			},

			gosz() {
				wx.navigateTo({
					url: '/pages/supervision/supervision_settings'
				});
			},
			gogrjs() {
				wx.navigateTo({
					url: '/pages/supervision/expertise'
				});
			}
		}
	}
</script>

<style>
	.kycontainer {
		display: flex;
		justify-content: space-between;
		align-items: center;
		padding: 20rpx 0 0 0;
		/* 可根据实际需要调整 */
		font-size: 28rpx;
		/* 文字大小 */
	}

	.left-text,
	.right-text {
		flex-grow: 1;
		text-align: center;
	}

	.divider {
		width: 1px;
		height: 50rpx;
		/* 根据需要调整高度 */
		background-color: #D8D8D8;
		/* 分割线颜色 */
	}

	.counselor-name-row {
		display: flex;
		align-items: center;
		margin-bottom: 20rpx;
		width: 100%;
		justify-content: space-between;
	}

	.counselor-name {
		font-weight: bold;
	}

	.m-l-10 {
		margin: 0 10rpx 0 0;
	}

	.counselor-detail {
		font-size: 24rpx;
		margin-bottom: 20rpx;
		margin: 10rpx 0;
	}

	.ctop {
		border-radius: 16rpx;
		margin: 20rpx 0;
		padding: 30rpx;
		background-color: #ffffff;
	}

	.counselor-stats-row {
		display: flex;
		justify-content: space-between;
		align-items: center;
		margin: 10rpx 0 20rpx 0;
	}

	.counselor-stats {
		font-size: 24rpx;
		color: #EF851A;
	}

	.instructor-item {
		display: flex;
		align-items: center;
		margin-bottom: 20rpx;
		/* 列表项间隔 */
		padding: 30rpx;
		background-color: #ffffff;
		border-radius: 26rpx;
	}

	.instructor-image {
		width: 100rpx;
		height: 100rpx;
		min-width: 100rpx;
		border-radius: 16rpx;
		margin-right: 20rpx;
		/* 图片与信息间隔 */
	}

	.instructor-info {
		display: flex;
		flex-direction: column;
	}

	.instructor-name {
		font-weight: bold;
		font-size: 32rpx;
		color: #242424;
		margin-bottom: 20rpx;
		/* 名字与简介间隔 */
	}

	.instructor-bio {
		font-size: 24rpx;
		display: -webkit-box;
		-webkit-box-orient: vertical;
		-webkit-line-clamp: 3;
		/* 限制为三行 */
		overflow: hidden;
		/* 超出部分隐藏 */
		text-overflow: ellipsis;
		/* 显示省略符号 */
	}

	.user-container {
		display: flex;
		align-items: center;
		padding: 0 20rpx;
	}

	.user-avatar {
		width: 72rpx;
		height: 72rpx;
		border: 1rpx solid #C6C6C6;
		border-radius: 50%;
		/* 使头像呈现圆形 */
	}

	.user-info {
		margin-left: 20rpx;
		/* 头像和文本之间的间隔 */
		display: flex;
		flex-direction: column;
	}

	.user-nickname {
		font-weight: 400;
		font-size: 24rpx;
		color: #242424;
	}

	.user-time {
		font-size: 24rpx;
		color: #999999;
		margin-top: 10rpx;
		/* 行与行之间的间隔 */
	}

	.user-con {
		font-size: 28rpx;
		color: #242424;
		padding: 20rpx 30rpx;

	}

	.line {
		width: 630rpx;
		height: 2rpx;
		background: #F6F6F6;
		margin: 20rpx 0;
		padding: 0 50rpx;
	}

	.image-gallery {
		display: flex;
		justify-content: space-around;
		/* 使图片均匀分布 */
		align-items: center;
		/* 垂直居中对齐 */
	}

	.gallery-image {
		width: 196rpx;
		height: 196rpx;
		border-radius: 10rpx;
		margin: 10rpx;
		/* 根据需要调整间距大小 */
	}

	.floating-bar {
		display: flex;
		justify-content: space-between;
		align-items: center;
		position: fixed;
		/* 固定位置 */
		left: 0;
		right: 0;
		bottom: 0;
		/* 悬浮在底部 */
		background-color: #FFFFFF;
		/* 背景颜色 */
		box-shadow: 0 -2rpx 8rpx rgba(0, 0, 0, 0.1);
		/* 底部阴影效果 */
		padding: 20rpx 30rpx;
		/* 内边距 */
		z-index: 1000;
		/* 确保悬浮栏在内容之上 */
	}

	.left-section {
		display: flex;

	}

	.icon-text {
		align-items: center;
		text-align: center;
		margin-right: 40rpx;
		position: relative;
	}

	.icon {
		width: 46rpx;
		height: 46rpx;
	}

	.appointment-button {
		height: 84rpx;
		background: linear-gradient(90deg, #D275F2 0%, #AE38D7 100%);
		border-radius: 44rpx;
		color: #FFFFFF;
		font-size: 30rpx;
		padding: 0 40rpx;
		/* 按钮内边距 */
		line-height: 84rpx;
	}

	.time-select-container {
		padding: 20rpx;
	}

	.time-select-header {
		display: flex;
		justify-content: space-between;
		align-items: center;
		margin-bottom: 20rpx;
	}

	.time-select-title {
		font-weight: bold;
		font-size: 32rpx;
		color: #242424;
	}

	.time-select-close {
		font-size: 30rpx;
	}

	.time-select-tabs {
		background-color: #fff;
	}

	.time-select-slots {
		display: flex;
		flex-wrap: wrap;
		justify-content: space-between;
		/* Ensures spacing and wrapping */
		margin: 10rpx;
		/* Negative margin for gap compensation */
	}

	.time-select-slot {
		width: 160rpx;
		min-width: 160rpx;
		height: 80rpx;
		background: #FFFFFF;
		border-radius: 40rpx;
		border: 1rpx solid #C2C2C2;
		display: flex;
		justify-content: center;
		align-items: center;
		margin: 10rpx 0;
	}

	.booked {
		background: #F6F6F6;
		border: 1rpx solid #E1E1E1;
	}

	.time-select-footer {
		display: flex;
		justify-content: start;
		padding: 20rpx;
	}

	.pay-btn {
		width: 690rpx;
		height: 88rpx;
		background: linear-gradient(90deg, #D275F2 0%, #AE38D7 100%);
		border-radius: 44rpx;

		position: fixed;
		bottom: 0;
		line-height: 88rpx;
		color: #fff;
		text-align: center;
	}
</style>