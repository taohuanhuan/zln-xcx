<template>
	<view class="main">
		<view class="card">
			<view class="title">投诉 / 建议</view>
			<view class="upload">
				<view class="title">内容：</view>
				 <u--textarea v-model="value1" placeholder="请输入投诉/建议内容" ></u--textarea>
			</view>

			<view class="upload">
				<view class="title">图片：</view>
					<u-upload
						:fileList="fileList1"
						@afterRead="afterRead"
						@delete="deletePic"
						name="1"
						multiple
						:maxCount="10"
					></u-upload>
			</view>

		</view>
		<view class="btn">提交</view>

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
		width: 690rpx;
		padding-top: 20rpx;
		background-color: #F6F6F6;
		min-height: 100vh;
		width: 690rpx;

		.card {
			background-color: white;
			padding: 30rpx;
			box-sizing: border-box;
			border-radius: 16rpx;

			.title {
				font-weight: bold;
				font-size: 32rpx;
				color: #242424;
			}

			.item {
				height: 88rpx;
				display: flex;
				justify-content: space-between;
				border-bottom: 1px solid #F6F6F6;
				align-items: center;

				.left {
					font-weight: 400;
					font-size: 28rpx;
					color: #242424;
				}

				.right {
					input {
						text-align: right;
						font-size: 28rpx;
						color: #999999;
					}
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
</style>