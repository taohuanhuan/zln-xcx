<template>
	<view class="main">

		<view class="card">
			<view class="title">联系方式</view>

			
			<view class="item">
				<view class="left">邮箱</view>
				<view class="desc">nitezugo@temus.ms</view>
			</view><view class="item">
				<view class="left">电话</view>
				<view class="desc">19669798647</view>
			</view>
			<view class="item">
				<view class="left">地址</view>
				<view class="desc">国美大厦二十楼2401</view>
			</view>

		</view>

	</view>
</template>

<script>
	export default {
		data() {
			return {
				fileList: [{
						url: 'https://img01.yzcdn.cn/vant/leaf.jpg'
					},
					{
						url: 'https://cloud-image',
						isImage: true
					},
				],
			};
		},

	}
</script>

<style lang="scss" scoped>
	.main {
		// padding-left: 30rpx;
		// padding-right: 30rpx;
		padding-top: 20rpx;
		background-color: #F6F6F6;
		min-height: 100vh;
		width: 690rpx;

		.card {
			background-color: white;
			padding: 30rpx;
			box-sizing: border-box;
			border-radius: 16rpx;
			margin-bottom: 20rpx;

			.title {
				font-weight: bold;
				font-size: 32rpx;
				color: #242424;
			}

			.text {
				font-weight: 400;
				font-size: 28rpx;
				color: #666666;
				margin-top: 40rpx;
			}

			.item {
				height: 80rpx;
				display: flex;
				align-items: center;

				// justify-content: space-between;
				.left {
					width: 130rpx;
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

			.upload {
				margin-top: 20rpx;

				.title {
					font-weight: 400;
					font-size: 28rpx;
					color: #666666;
					margin-bottom: 20rpx;
				}

				.text {
					background-color: #F6F6F6;
					border-radius: 16rpx;
					padding: 20rpx;
					box-sizing: border-box;
					height: 160rpx;
				}
			}
		}

	}

	.btn {
		position: fixed;
		bottom: 0;
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
</style>