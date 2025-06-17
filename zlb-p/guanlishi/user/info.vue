<template>
	<view class="main">
		<view class="card">
			<view class="item" @click="upload">
				<view class="left" >头像</view>
				<view class="right">
					<image class="avatar" src="../../static/img/avatar.png"></image>
					<image class="icon" src="../../static/img/jiantou-r.png"></image>
				</view>
			</view>
			<view class="item" @click="navPage('/guanlishi/user/nicheng')"> 
				<view class="left">昵称</view>
				<view class="right">
					<view class="text">小吴爱吃甜食</view>
					<image class="icon" src="../../static/img/jiantou-r.png"></image>
				</view>
			</view>
			<view class="item" @click="navPage('/guanlishi/user/xingming')">
				<view class="left">姓名</view>
				<view class="right">
					<view class="text">佳慧</view>
					<image class="icon" src="../../static/img/jiantou-r.png"></image>
				</view>
			</view>
			<view class="item" @click="navPage('/guanlishi/user/tags')">
				<view class="left">个性标签</view>
				<view class="right">
					<view class="tag">
						<view class="item">情绪压力</view>
						<view class="item">情绪压力</view>
					</view>
					<image class="icon" src="../../static/img/jiantou-r.png"></image>
				</view>
			</view>
			<view class="item" @click="navPage('/guanlishi/user/gerenjianjie')">
				<view class="left">个人简介</view>
				<view class="right">
					<image class="icon" src="../../static/img/jiantou-r.png"></image>
				</view>
			</view>
			<view class="item" @click="navPage('/guanlishi/user/zhengshu')">
				<view class="left">证书</view>
				<view class="right">
					<!-- <view class="text">证书</view> -->
					<image class="icon" src="../../static/img/jiantou-r.png"></image>
				</view>
			</view>


		</view>
		<!-- <view class="btn">确认新增</view> -->

	</view>
</template>

<script>
	export default {
		data() {
			return {
				// value: '男'
			};
		},
		methods:{
			navPage(url) {
				uni.navigateTo({
					url
				})
			},
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

<style lang="scss" scoped>
	.main {
		padding-top: 20rpx;
		background-color: #F6F6F6;
		min-height: 100vh;

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
					display: flex;
					align-items: center;
					input {
						text-align: right;
						font-size: 28rpx;
						color: #999999;
					}
					
					.icon{
						width: 30rpx;
						height: 30rpx;
					}

					.avatar {
						width: 88rpx;
						height: 88rpx;
						border-radius: 50%;
					}

					.tag {
						display: flex;

						.item {
							font-weight: 400;
							font-size: 20rpx;
							color: #7F6FDF;
							font-weight: 400;
							font-size: 20rpx;
							color: #7F6FDF;
							margin-left: 10rpx;
							height: 32rpx;
							background: #F6F4FE;
							border-radius: 4rpx;
							padding: 0 10rpx;
						}
					}
					
					.text{
						font-weight: 400;
						font-size: 28rpx;
						color: #242424;
					}
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