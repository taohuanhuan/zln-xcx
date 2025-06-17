<template>
	<view class="main">
		<view style="background-color: white;">
			<view style="height:108rpx ;"></view>
			<view style="text-align: center;font-weight: 600;
		font-size: 34rpx;
		color: #242424;">消息</view>
			<view style="height: 30rpx;"></view>
		</view>

		<view class="header">
			<view class="btn-group">
				<view class="btn " :class="active==1?'active':''" @click="changTab(1)">
					未读
					<template v-if="active ==1">
						<view class="line"></view>
					</template>
				</view>
				<view class="btn" :class="active==2?'active':''" @click="changTab(2)">
					已读
					<template v-if="active ==2">
						<view class="line"></view>
					</template>
				</view>
			</view>
			<view class="  btn-all" @click="changTab(2)">一键已读</view>
		</view>


		<view class="content">
			<view class="item1" v-for="item in list" @click="navPage('/guanlishi/order/detail_online')">
				<view class="top">
					<view class="title">新订单消息</view>
					<template v-if="item.status==1">
						<view class="status"></view>
					</template>

				</view>
				<view class="msg">您收到一条新的预约订单消息，请前往查看</view>
				<view class="time">2024.05.05 09:34:22</view>
			</view>

		</view>

		<view class="tabbar">
			<view class="item" @click="redirectPage('/guanlishi/index/index')">
				<image class="icon" src="/static/tab/index.png"></image>
				<view class="name ">首页</view>
			</view>
			<view class="item" @click="redirectPage('/guanlishi/order/order')">
				<image class="icon" src="/static/tab/order.png"></image>
				<view class="name ">订单</view>
			</view>
			<view class="item" @click="redirectPage('/guanlishi/message/message')">
				<image class="icon" src="/static/tab/message_s.png"></image>
				<view class="name active">消息</view>
			</view>
			<view class="item" @click="redirectPage('/guanlishi/mine/mine')">
				<image class="icon" src="/static/tab/mine.png"></image>
				<view class="name ">我的</view>
			</view>
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				active: 1,
				list: [{
						status: 1
					},
					{
						status: 1
					}
				]
			}
		},
		methods: {
			redirectPage(url) {
				uni.reLaunch({
					url
				})
			},
			changTab(idx) {
				if (idx == 2 || idx == 3) {
					this.list = [{
							status: 2
						},
						{
							status: 2
						}
					]
				} else {
					this.list = [{
							status: 1
						},
						{
							status: 1
						}
					]
				}
				this.active = idx
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
	.tabbar {
		position: fixed;
		bottom: 0;
		left: 0;
		width: 750rpx;
		height: 160rpx;
		background-color: white;
		display: grid;
		grid-template-columns: repeat(4, 1fr);

		.item {
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;

			.icon {
				width: 56rpx;
				height: 56rpx;
			}

			.name {
				font-weight: bold;
				font-size: 20rpx;
				color: #999999;
			}

			.active {
				color: #BB4FE1;
			}
		}
	}

	.main {
		min-height: 100vh;
		background-color: #f6f6f6;

		.header {
			height: 100rpx;
			background-color: white;
			display: flex;
			justify-content: space-between;
			align-items: center;
			padding-left: 60rpx;
			padding-right: 30rpx;
			font-weight: 400;
			font-size: 28rpx;
			color: #666666;

			.btn-group {
				display: flex;

				.btn {
					margin-right: 114rpx;
				}

				.active {
					font-weight: bold;
					font-size: 32rpx;
					color: #242424;

					.line {
						content: "";
						width: 64rpx;
						height: 12rpx;
						background: #C871E7;
						border-radius: 6rpx;
					}

				}



			}

		}

		.content {
			margin-left: 30rpx;
			margin-right: 30rpx;
			background-color: #f6f6f6;

			.item1 {
				width: 690rpx;
				border-radius: 16rpx;
				background-color: white;
				padding: 30rpx;
				box-sizing: border-box;
				margin-top: 20rpx;

				.top {
					display: flex;
					justify-content: space-between;
					align-items: center;

					.title {
						font-weight: bold;
						font-size: 30rpx;
						color: #242424;
					}

					.status {
						width: 16rpx;
						height: 16rpx;
						border-radius: 50%;
						background-color: red;

					}
				}

				.msg {
					font-weight: 400;
					font-size: 24rpx;
					color: #666666;
					margin-top: 20rpx;
				}

				.time {
					font-weight: 400;
					font-size: 24rpx;
					color: #999999;
					margin-top: 20rpx;
				}
			}
		}
	}
</style>

<style>
	page {
		background-color: #F6F6F6;
		/* 这里设置你想要的背景颜色 */
		padding: 0 0;
	}
</style>