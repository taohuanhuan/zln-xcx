<template>
	<view class="main">
		<view class="card">
			<view class="item" @click="upload">
				<view class="left">头像</view>
				<view class="right">
					<image class="avatar" src="../../static/temp/avatar.png"></image>
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
			<view class="item"  @click="show = true">
				<view class="left">性别</view>
				<view class="right">
					<view class="text">男</view>
					<image class="icon" src="../../static/img/jiantou-r.png"></image>
				</view>
			</view>
			<view class="item" @click="navPage('/pages/my/age')">
				<view class="left">年龄</view>
				<view class="right">
					<view class="text">36</view>
					<image class="icon" src="../../static/img/jiantou-r.png"></image>
				</view>
			</view>
			<view class="item" >
				<view class="left">角色</view>
				<view class="right">
					<u-radio-group v-model="value1" placement="row">
						<u-radio activeColor="#AE38D7" label="本人"></u-radio>
						<u-radio activeColor="#AE38D7" label="代诊"></u-radio>
					</u-radio-group>
				</view>
			</view>
			
			<view class="item" @click="navPage('/pages/my/jiaren')">
				<view class="left">家人</view>
				<view class="right">
					<view class="text"></view>
					<image class="icon" src="../../static/img/jiantou-r.png"></image>
				</view>
			</view>
			<view class="item" >
				<view class="left">用户档案</view>
				<view class="right">
					<u-switch v-model="value3" size="20"  activeColor="#00AF6A" ></u-switch>
					<view style="width: 20rpx;"></view>
					<view class="text1" >隐私</view>
				</view>
			</view>
			
			<view class="user-dangan">
				<view class="doc">用户档案信息.word</view>
				<view class="btn">下载</view>
			</view>

		</view>
		<u-picker :show="show" :columns="columns" @change="changeShow"></u-picker>
		<u-picker :show="showAge" :columns="columns" @change="changeShow"></u-picker>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				value3:false,
				show: false,
				showAge: false,
				columns: [
					['男', '女']
				],
				
			};
		},
		onLoad() {
		
		},
		methods: {
			changeShow(){
				this.show =false
			},
			navPage(url) {
				uni.navigateTo({
					url
				})
			},
			upload() {
				uni.chooseImage({
					count: 1, //默认9
					sizeType: ['original', 'compressed'], //可以指定是原图还是压缩图，默认二者都有
					sourceType: ['album'], //从相册选择
					success: function(res) {
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
					display: flex;
					align-items: center;

					input {
						text-align: right;
						font-size: 28rpx;
						color: #999999;
					}

					.icon {
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
						}
					}

					.text {
						font-weight: 400;
						font-size: 28rpx;
						color: #242424;
					}
					.text1 {
						font-weight: 400;
						font-size: 24rpx;
						color: #242424;
					}
				}

			}
		}

	}

	// .btn {
	// 	position: fixed;
	// 	bottom: 0;
	// 	width: 690rpx;
	// 	height: 88rpx;
	// 	background: linear-gradient(90deg, #D275F2 0%, #AE38D7 100%);
	// 	border-radius: 44rpx;
	// 	font-weight: bold;
	// 	font-size: 28rpx;
	// 	color: #FFFFFF;
	// 	line-height: 88rpx;
	// 	text-align: center;
	// }
	
	.user-dangan{
		.doc{
			font-weight: 400;
			font-size: 24rpx;
			color: #AE38D7;
		}
		.btn{
			width: 108rpx;
			height: 52rpx;
			border-radius: 30rpx;
			border: 2rpx solid #AE38D7;
			font-weight: 400;
			font-size: 24rpx;
			color: #AE38D7;
			text-align: center;
			line-height: 52rpx;
			margin-top: 30rpx;
		}
	}
</style>