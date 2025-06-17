<template>
	<view class="payment-success">
		<image src="../../static/img/ywc.png" class="success-icon"></image>
		<text class="success-message">支付成功</text>
		<view class="order-details">
			<view class="order-row">
				<text>订单号</text>
				<text>4944979705557980981</text>
			</view>
			<view class="order-row">
				<text>付款方式</text>
				<text>微信支付</text>
			</view>
			<view class="order-row">
				<text>收款方</text>
				<text>深圳金仕达优先科技公司</text>
			</view>
		</view>

		<view class="pay-btn">
			完成
		</view>
	</view>
</template>


<script>
	export default {
		data() {
			return {

			}
		},
		methods: {

		}
	}
</script>

<style scoped>
	.payment-success {
		display: flex;
		flex-direction: column;
		align-items: center;
		text-align: center;
	}

	.success-icon {
		width: 100rpx;
		height: 100rpx;
		margin-top: 100rpx;
	}

	.success-message {
		font-weight: bold;
		font-size: 40rpx;
		color: #242424;
		margin-top: 20rpx;
		margin-bottom: 60rpx;
	}

	.order-details {
		width: 100%;
		display: flex;
		flex-direction: column;
		justify-content: center;
		background-color: #fff;
		border-radius: 24rpx;
		box-shadow: 0 4rpx 12rpx rgba(0, 0, 0, 0.05);
		height: 300rpx;
		/* 轻微的阴影 */
	}

	.order-row {
		display: flex;
		justify-content: space-between;
		align-items: center;
		padding: 0 30rpx;
		font-size: 28rpx;
		color: #242424;
		font-weight: 400;
		height: 100rpx;
		/* line-height: 100rpx; */
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
	}
</style>