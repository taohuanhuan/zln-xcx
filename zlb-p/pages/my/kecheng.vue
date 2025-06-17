<template>
	<view>
		<view class="card"  @click="navPage('/pages/order/detail_online')">
			<view class="top">
				<view class="num">4944979705557980981</view>
				<view class="status">线上</view>
			</view>
			<view class="c-main">
				<view class="img">
		
				</view>
				<view class="info">
					<view class="name mb">萌善治</view>
					<view class="i-title mb">我是服务项目名称</view>
					<view class="time mb">项目服务时间：2024.05.01 08：00-09:00</view>
					<view class="price mb">¥2383.00</view>
				</view>
		
		
			</view>
			<view class="drive"></view>
			<view class="create-time">2024.05.01 09:34:22</view>
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				
			};
		}
	}
</script>

<style lang="scss" scoped>
.card {
			margin-top: 20rpx;
			width: 690rpx;
			height: 406rpx;
			box-sizing: border-box;
			padding: 30rpx;
			background-color: white;
			border-radius: 16rpx;

			.top {
				display: flex;
				justify-content: space-between;

				.num {
					font-weight: 400;
					font-size: 28rpx;
					color: #242424;
				}

				.status {
					color: #666666;
					font-weight: 400;
					font-size: 28rpx;
				}
			}

			.c-main {
				display: flex;
				margin-top: 20rpx;

				.img {
					width: 120rpx;
					height: 120rpx;
					border-radius: 50%;
					background-color: #242424;
				}

				.info {
					display: flex;
					margin-left: 20rpx;
					flex-direction: column;
					justify-content: space-between;

					.name {
						font-weight: bold;
						font-size: 30rpx;
						color: #242424;
					}

					.i-title {
						width: 192rpx;
						font-family: PingFangSC, PingFang SC;
						font-weight: 400;
						font-size: 24rpx;
						color: #666666;
						line-height: 34rpx;
						text-align: left;
						font-style: normal;
					}

					.time {
						width: 460rpx;
						height: 34rpx;
						font-family: PingFangSC, PingFang SC;
						font-weight: 400;
						font-size: 24rpx;
						color: #666666;
						line-height: 34rpx;
						text-align: left;
						font-style: normal;
					}

					.price {
						width: 140rpx;
						height: 44rpx;
						font-family: PingFang-SC, PingFang-SC;
						font-weight: bold;
						font-size: 24rpx;
						color: #E62626;
						line-height: 34rpx;
						text-align: left;
						font-style: normal;
					}

					.mb {
						margin-bottom: 20rpx;
					}
				}
			}

			.drive {
				height: 2rpx;
				width: 630rpx;
				margin-left: 30rpx;
				background-color: #F6F6F6;
				margin-bottom: 20rpx;
			}

			.create-time {
				font-weight: 400;
				font-size: 28rpx;
				color: #666666;
			}
		} 
</style>
