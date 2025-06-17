<template>
	<view class="main">
		<view class="card">
		
			<view class="desc">
				内容：
			</view>
			<view class="text">
				<u--textarea v-model="value1" placeholder="请输入内容"></u--textarea>
			</view>
			<view class="desc">
				证书：
			</view>
			<view class="zhengshu">
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
		
		<view class="btn-group">
			<view class="btn" >提交</view>
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				value1: '',
			};
		}
	}
</script>

<style lang="scss" scoped>
	.main {
		min-height: 100vh;
		background-color: #F6F6F6;

		.card {
			background-color: white;
			border-radius: 16rpx;
			padding: 30rpx;
			box-sizing: border-box;

			.title {
				font-weight: bold;
				font-size: 32rpx;
				color: #242424;
			}

			.desc {
				font-weight: 400;
				font-size: 28rpx;
				color: #666666;
				margin-top: 30rpx;
			}
			.text{
				margin-top: 30rpx;
			}
			.zhengshu{
				margin-top: 20rpx;
			}
		}
		
		.btn-group{
			position: fixed;
			bottom: 0;
			left: 0;
			width: 750rpx;
			height: 166rpx;
			background: #FFFFFF;
			box-shadow: 0rpx -2rpx 12rpx 0rpx rgba(36,36,36,0.05);
			
			.btn{
				width: 690rpx;
				height: 88rpx;
				margin-left: 30rpx;
				margin-top: 20rpx;
				background: linear-gradient( 90deg, #D275F2 0%, #AE38D7 100%);
				border-radius: 44rpx;
				font-weight: bold;
				font-size: 28rpx;
				color: #FFFFFF;
				text-align: center;
				line-height: 88rpx;
			}
		}
	}
</style>