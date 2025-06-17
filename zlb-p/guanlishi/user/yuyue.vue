<template>
	<view class="main">
		<view class="title">预约信息</view>
		<view class="msg">

			<view class="item" @click="show1=true">
				<view class="left">
					<view class="question">预约时间</view>
				</view>
				<view class="right">
					<view class="text">请选择预约时间 </view>
					<image class="r-icon" src="../../static/img/jiantou-r.png"></image>
				</view>



			</view>
			<view class="item" @click="navPage('/guanlishi/user/yuyue_user')">
				<view class="left">
					<view class="question">预约用户</view>
				</view>
				<view class="right">
					<view class="text">请选择 </view>
					<image class="r-icon" src="../../static/img/jiantou-r.png"></image>
				</view>
			</view>
			<view class="item">
				<view class="left">
					<view class="question">预约服务</view>
				</view>
				<view class="right" @click="show = true">
					<view class="text">请选择 </view>
					<image class="r-icon" src="../../static/img/jiantou-r.png"></image>
				</view>
			</view>

			<view class="btn">确认预约</view>

		</view>

		<u-popup :show="show" @close="close" @open="open">
			<view>
				<view class="p-header">
					<view class="title">选择预约服务</view>
					<image class="icon" src="../../static/img/shanchu.png" @click="show=false"></image>
				</view>
				<view class="card">
					<view class="top">
						<view class="p-title">我是服务项目名称</view>
						<view class="price">¥128.00</view>
					</view>
					<view class="desc">
						我是服务项目的描述信息占位符，当你的伙伴需要你伸出一只手时，不妨把肩膀也给他
					</view>
				</view>

				<view style="height: 50rpx;"></view>
			</view>
		</u-popup>
		<u-datetime-picker :show="show1" v-model="value1" mode="datetime" @change="show1=false"></u-datetime-picker>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				show: false,
				show1: false,
			};
		},
		methods: {
			open() {
				// console.log('open');
			},
			close() {
				this.show = false
				// console.log('close');
			},
			navPage(url) {
				uni.navigateTo({
					url
				})
			}
		}
	}
</script>

<style lang="scss" scoped>
	.main {
		background-color: #F6F6F6;
		min-height: 100vh;
		padding-left: 30rpx;
		padding-right: 30rpx;
		padding-top: 30rpx;
	}

	.p-header {
		display: flex;
		justify-content: space-between;
		align-items: center;
		padding-right: 30rpx;
	}

	.title {
		font-weight: bold;
		font-size: 32rpx;
		color: #242424;
		background-color: white;
		padding: 30rpx;
	}

	.icon {
		width: 30rpx;
		height: 30rpx;

	}

	.msg {
		background-color: white;

		.item {
			height: 100rpx;
			width: 690rpx;
			background-color: white;
			border-bottom: 1px solid #f6f6f6;
			display: flex;
			align-items: center;
			justify-content: space-between;
			padding-left: 20rpx;
			padding-right: 20rpx;
			box-sizing: border-box;

			.left {
				display: flex;
				align-items: center;

				.l-icon {
					width: 20rpx;
					height: 20rpx;
				}

				.question {
					margin-left: 20rpx;
				}

			}

			.right {
				display: flex;
				align-items: center;

				.text {
					padding-right: 20rpx;
					font-weight: 400;
					font-size: 28rpx;
					color: #999999;
				}

				.r-icon {
					width: 20rpx;
					height: 20rpx;
				}
			}


		}
	}


	.card {
		width: 690rpx;
		height: 196rpx;
		background: #FEFAFF;
		border-radius: 16rpx;
		border: 2rpx solid #AE39D7;
		margin-left: 30rpx;
		padding: 30rpx;
		box-sizing: border-box;

		.top {
			display: flex;
			align-items: center;
			justify-content: space-between;
			font-weight: bold;
			font-size: 28rpx;
			color: #242424;
		}

		.desc {
			font-weight: 400;
			font-size: 24rpx;
			color: #999999;
		}
	}

	.btn {
		width: 690rpx;
		height: 88rpx;
		background: linear-gradient(90deg, #D275F2 0%, #AE38D7 100%);
		border-radius: 44rpx;
		line-height: 88rpx;
		text-align: center;
		position: fixed;
		bottom: 50rpx;
		left: 30rpx;
		font-weight: bold;
		font-size: 28rpx;
		color: #FFFFFF;
	}
</style>

<style>
	page {
		background-color: #F6F6F6;
		/* 这里设置你想要的背景颜色 */
		padding: 0 0;
	}
</style>