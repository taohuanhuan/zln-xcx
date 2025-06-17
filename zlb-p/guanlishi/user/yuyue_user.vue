<template>
	<view>
		<view class="search">
			<view class="container">
				<u-search :showAction="false" placeholder="请输入关键词搜索查询" v-model="keyword"></u-search>
			</view>
		</view>

		<view class="main">
			<view style="height: 20rpx;"></view>
			<view class="card" >
				<view class="left">
					<image class="avatar" src="../../static/img/avatar.png"></image>
					<view class="user">
						<view class="name">宫琦</view>
						<view class="phone">152 **** 8890</view>
					</view>
				</view>
				<view class="right" >
					<image  class="icon" src="../../static/img/gouxuan.png"></image>
				</view>
			</view>

			<view class="btn" >确认</view>
		</view>

	</view>
</template>

<script>
	export default {
		data() {
			return {
				keyword: ''
			}
		},
		methods: {
			navPage(url){
				uni.navigateTo({
					url
				})
			}
		}
	}
</script>

<style lang="scss" scoped>
	.search {
		width: 750rpx;
		height: 100rpx;
		background-color: white;

		.container {
			padding-left: 30rpx;
			padding-right: 30rpx;
			padding-top: 20rpx;
			box-sizing: border-box;
		}
	}

	.main {
		background-color: #F6F6F6;
		min-height: 100vh;
		padding-left: 30rpx;
		padding-right: 30rpx;

		.card {
			width: 690rpx;
			height: 132rpx;

			background-color: white;
			box-sizing: border-box;
			padding-left: 30rpx;
			padding-right: 30rpx;
			padding-top: 20rpx;
			display: flex;
			justify-content: space-between;
			border-radius: 16rpx;

			.left {
				display: flex;
				align-items: center;

				.avatar {
					width: 98rpx;
					height: 98rpx;
					border: 1rpx solid #C6C6C6;
					border-radius: 50%;
				}

				.user {
					// width: 180rpx;
					margin-left: 20rpx;

					.name {
						font-weight: bold;
						font-size: 28rpx;
						color: #242424;
					}

					.phone {
						font-weight: 400;
						font-size: 24rpx;
						color: #999999;
						margin-top: 10rpx;
					}
				}
			}

			.right {
				display: flex;
				align-items: center;

				.text {
					font-weight: 400;
					font-size: 24rpx;
					color: #242424;
				}

				.r-icon {
					width: 19rpx;
					height: 20rpx;
				}
				.icon{
					width: 40rpx;
					height: 40rpx;
				}
			}

		}

		.btn {
			position: fixed;
			bottom: 50rpx;
			width: 690rpx;
			height: 88rpx;
			background: linear-gradient(90deg, #D275F2 0%, #AE38D7 100%);
			border-radius: 44rpx;
			font-weight: bold;
			font-size: 28rpx;
			color: #FFFFFF;
			line-height: 88rpx;
			text-align: center;
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