<template>
	<view class="main">
		<view class="item">
			<image class="avatar" src="../../static/img/avatar.png"></image>
			<view class="del">
				<image class="icon" src="../../static/img/shanchu.png"></image>
			</view>
		</view>
		<view class="item">
			<image class="avatar" src="../../static/img/avatar.png"></image>
			<view class="del">
				<image class="icon" src="../../static/img/shanchu.png"></image>
			</view>
		</view>
		<view class="item">
			<image class="avatar" src="../../static/img/avatar.png"></image>
			<view class="del">
				<image class="icon" src="../../static/img/shanchu.png"></image>
			</view>
		</view>
		
		<view class="btn" @click="upload">
			上传
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {

			};
		},
		methods:{
			upload(){
				uni.chooseImage({
					count: 1, //默认9
					sizeType: ['original', 'compressed'], //可以指定是原图还是压缩图，默认二者都有
					sourceType: ['album'], //从相册选择
					success: function (res) {
						console.log(JSON.stringify(res.tempFilePaths));
					}
				});
			}
		}
	}
</script>

<style lang="scss">
	.main {
		padding-top: 20rpx;
		background-color: #F6F6F6;
		min-height: 100vh;
		
		.item{
			width: 690rpx;
			height: 240rpx;
			position: relative;
			margin-bottom: 20rpx;
			
			.avatar{
				border-radius: 16rpx;
				width: 100%;
				height: 100%;
			}
			.del{
				position: absolute;
				width: 30rpx;
				height: 30rpx;
				border-radius: 50%;
				background-color: #cbcbcb;
				top: 0;
				right: 0;
				text-align: center;
				line-height: 30rpx;
				color: white;
				.icon{
					width: 100%;
					height: 100%;
				}
			}
		}
	}
	
	.btn{
		position: fixed;
		bottom: 50rpx;
		left: 30rpx;
		width: 690rpx;
		height: 88rpx;
		background: linear-gradient( 90deg, #D275F2 0%, #AE38D7 100%);
		border-radius: 44rpx;
		font-weight: bold;
		font-size: 28rpx;
		color: #FFFFFF;
		text-align: center;
		line-height: 88rpx;
	}
</style>