<template>
	<view>
		<image class="avatar" src="../../static/img/shouru-bg.png"></image>
		<view class="main">
			<view class="all">总收入</view>
			<view class="num">9800.00</view>
			<view class="card">
				<view class="btn-group-le">
					<view class="btn " :class="active==1?'active':''" @click="changeTab(1)">一级好友</view>
					<view class="btn " :class="active==2?'active1':''" @click="changeTab(2)">二级好友</view>
				</view>
				<view class="list">
					<view class="num">好友数量：87</view>
					<view class="item" v-for="item in 5">
						<image class="avatar" src="../../static/temp/avatar.png"></image>
						<view class="user">
							<view class="name">郭靖</view>
							<view class="desc">加入时间：2024.05.05 09:34</view>
						</view>
					</view>
				</view>
			</view>
		</view>

		<view class="btn-group">
			<view class="btn" @click="navPage('/pages/yaoqing/mingxi')">收入明细</view>
			<view class="btn active" @click="navPage('/pages/yaoqing/tixian')">收款记录</view>
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				active: 1
			};
		},
		methods: {
			changeTab(idx){
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
	.avatar {
		width: 750rpx;
		height: 400rpx;
	}

	.main {
		position: absolute;
		top: 40rpx;
		padding-left: 30rpx;
		padding-right: 30rpx;
		padding-top: 20rpx;
		// background-color: #F6F6F6;
		min-height: 100vh;
		width: 690rpx;

		.all {
			font-weight: 400;
			font-size: 28rpx;
			color: #666666;
		}

		.num {
			font-weight: bold;
			font-size: 72rpx;
			color: #242424;
			margin-top: 20rpx;
			margin-bottom: 20rpx;

		}

		.card {
			border-radius: 16rpx;

			.btn-group-le {
				width: 690rpx;
				display: flex;
				background-color: white;

				.btn {
					width: 364rpx;
					height: 88rpx;
					background: #FFFFFF;
					line-height: 88rpx;
					text-align: center;
					font-weight: bold;
					font-size: 28rpx;
					color: #242424;

				}

				.active {
					background: #F6F6F6;
					border-bottom-right-radius: 40rpx;
				}
				
				.active1 {
					background: #F6F6F6;
					border-bottom-left-radius: 40rpx;
				}
			}

			.list {
				width: 690rpx;
				padding: 30rpx;
				box-sizing: border-box;
				background-color: white;

				.num {
					font-weight: 400;
					font-size: 28rpx;
					color: #242424;
					margin-bottom: 20rpx;
				}

				.item {
					display: flex;
					height: 104rpx;
					margin-top: 30rpx;
					border-bottom: 1px solid #F6F6F6;

					.avatar {
						width: 72rpx;
						height: 72rpx;
						border-radius: 50%;
						border: 1rpx solid #C6C6C6;
					}

					.user {
						margin-left: 20rpx;
						height: 72rpx;
						display: flex;
						flex-direction: column;
						justify-content: space-between;

						.name {
							font-weight: 400;
							font-size: 24rpx;
							color: #242424;
						}

						.desc {
							font-weight: 400;
							font-size: 24rpx;
							color: #999999;
						}
					}
				}


			}
		}
	}

	.btn-group {
		position: fixed;
		bottom: 0;
		display: flex;
		justify-content: space-between;
		box-sizing: border-box;
		width: 750rpx;
		height: 166rpx;
		background: #FFFFFF;
		padding: 10rpx 40rpx 0 40rpx;

		.btn {
			width: 320rpx;
			height: 88rpx;
			border-radius: 44rpx;
			border: 2rpx solid #AE38D7;
			line-height: 88rpx;
			text-align: center;
			font-weight: bold;
			font-size: 30rpx;
			color: #AE38D7;
		}

		.active {
			background: linear-gradient(90deg, #D275F2 0%, #AE38D7 100%);
			color: white;
		}
	}
</style>

<style>
	page {
		padding: 0;
	}
</style>