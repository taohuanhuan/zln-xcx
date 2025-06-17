<template>
	<view>
		<view class="card">
			<view class="top">
				<view class="title">3次限时7折</view>
				<view class="status">待使用</view>
			</view>
			<view class="middle">
				<view class="left">
					<view class="price">￥39.9</view>
					<view class="expire">有效期：2024.05.05～2024.06.05</view>
				</view>
				<view class="diff">剩余可用次数：1</view>
			</view>

			<view class="bottom">
				<view class="time">2024.05.05 09:34:22</view>
				<view class="btn">去使用</view>
			</view>

			<view class="drive"></view>
			<view class="shuoming">
				<view class="title">
					使用说明：
				</view>
				<view class="desc">1.我是使用说明占位符，我是占位符，是使用说明占位符，我是占位符； 2.我是使用说明占位符，我是占位符;
					3.我是使用说明占位符，我是占位符，是使用说明占位符，我是占位符.</view>
			</view>
		</view>

		<view class="card">
			<view class="top">
				<view class="title">购买记录</view>
			</view>
			<view class="list">
				<view class="order">
					<view class="title">购买时间</view>
					<view class="desc">2024.05.05 09:34:22</view>
				</view>
				<view class="order">
					<view class="title">订单编号</view>
					<view class="desc">4944979705557980981</view>
				</view>
			</view>
		</view>
		
		<view class="card">
			<view class="top">
				<view class="title">使用记录</view>
			</view>
			<view class="list">
				<view class="order">
					<view class="title">使用时间</view>
					<view class="desc">2024.05.05 09:34:22</view>
				</view>
				<view class="order">
					<view class="title">订单编号</view>
					<view class="desc">4944979705557980981</view>
				</view>
			</view>
			
			<view class="drive"></view>
			<view class="list">
				<view class="order">
					<view class="title">使用时间</view>
					<view class="desc">2024.05.05 09:34:22</view>
				</view>
				<view class="order">
					<view class="title">订单编号</view>
					<view class="desc">4944979705557980981</view>
				</view>
			</view>
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
	.order {
		display: flex;
		margin-top: 20rpx;

		.title {
			width: 160rpx;
			font-weight: 400;
			font-size: 28rpx;
			color: #666666;

		}

		.desc {
			font-weight: 400;
			font-size: 28rpx;
			color: #242424;
		}
	}

	.drive {
		width: 630rpx;
		height: 2rpx;
		background: #F6F6F6;
		margin: 30rpx 0;
	}

	.card {
		width: 690rpx;
		// margin-left: 30rpx;
		padding: 30rpx;
		box-sizing: border-box;
		background-color: white;
		margin-top: 30rpx;
		border-radius: 16rpx;

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
				font-weight: 400;
				font-size: 28rpx;
				color: #666666;
			}
		}

		.middle {
			display: flex;
			justify-content: space-between;
			align-items: center;

			.left {

				.price {
					font-weight: bold;
					font-size: 24rpx;
					color: #E62626;
				}

				.expire {
					font-weight: 400;
					font-size: 24rpx;
					color: #666666;
				}
			}

			.diff {
				font-weight: 400;
				font-size: 24rpx;
				color: #242424;
			}
		}

		.bottom {
			display: flex;
			justify-content: space-between;
			align-items: end;

			.time {
				font-weight: 400;
				font-size: 24rpx;
				color: #999999;
			}

			.btn {
				width: 120rpx;
				height: 52rpx;
				border-radius: 30rpx;
				border: 2rpx solid #AE38D7;
				line-height: 52rpx;
				text-align: center;
				font-weight: 400;
				font-size: 24rpx;
				color: #AE38D7;
			}
		}

		.shuoming {
			.title {
				font-weight: bold;
				font-size: 24rpx;
				color: #242424;
				line-height: 34rpx
			}

			.desc {
				font-weight: 400;
				font-size: 24rpx;
				color: #666666;
				margin-top: 30rpx;
			}
		}
	}
</style>