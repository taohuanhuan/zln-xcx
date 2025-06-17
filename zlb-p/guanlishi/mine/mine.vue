<template>
	<view>
		<view class="header"> 
			<image class="h-img" src="../../static/img/loginbg.png" ></image>
			<view class="title">我的</view>
			<view class="info" @click="navPage('/guanlishi/user/info')">
				<view class="avatar">
					<image src="../../static/img/avatar.png"></image>
				</view>
				<view class="user">
					<view class="name">橘子味汽水</view>
					<view class="tag">
						<view class="item">情绪压力</view>
					</view>
					<view class="id">165262638890</view>
				</view>
			</view>
			
			<view class="msg">
				<view class="item" @click="navPage('/guanlishi/user/zixunshijian')">
					<view class="left" >
						<image class="l-icon" src="../../static/img/zixunshijian.png"></image>
						<view class="question">咨询时间</view> 
					</view>
					<image class="r-icon" src="../../static/img/jiantou-r.png"></image>
				</view>
				<view class="item" @click="navPage('/guanlishi/mine/changjianwenti')">
					<view class="left">
						<image class="l-icon" src="../../static/img/changjainwenti.png"></image>
						<view class="question">常见问题</view>
					</view>
					<image class="r-icon" src="../../static/img/jiantou-r.png"></image>
				</view>
				<view class="item" @click="navPage('/guanlishi/user/dudaojilu')">
					<view class="left">
						<image class="l-icon" src="../../static/img/dudaojilu.png"></image>
						<view class="question">督导记录 </view>
					</view>
					<image class="r-icon" src="../../static/img/jiantou-r.png"></image>
				</view>
				
		<!-- 		<view class="item" @click="switUser('/pages/index/index')">
					<view class="left">
						<image class="l-icon" src="../../static/img/jiantou-r.png"></image>
						<view class="question">切换角色 </view>
					</view>
					<image class="r-icon" src="../../static/img/jiantou-r.png"></image>
				</view> -->
				
			</view>
			
			<view class="msg1" >
				
				<view class="item" @click="switUser('/pages/index/index')">
					<view class="left">
						<image class="l-icon" style="width: 40rpx;height: 40rpx;" src="../../static/img/wd6.png"></image>
						<view class="question">切换角色 </view>
					</view>
					<image class="r-icon" src="../../static/img/jiantou-r.png"></image>
				</view>
			</view>
			
			
			
		</view>
		<view class="tabbar">
			<view class="item" @click="redirectPage('/guanlishi/index/index')">
				<image class="icon" src="/static/tab/index.png"></image>
				<view class="name ">首页</view>
			</view>
			<view class="item" @click="redirectPage('/guanlishi/order/order')">
				<image class="icon" src="/static/tab/order.png"></image>
				<view class="name ">订单</view>
			</view>
			<view class="item" @click="redirectPage('/guanlishi/message/message')">
				<image class="icon" src="/static/tab/message.png"></image>
				<view class="name">消息</view>
			</view>
			<view class="item"  @click="redirectPage('/guanlishi/mine/mine')">
				<image class="icon" src="/static/tab/mine_s.png"></image>
				<view class="name active">我的</view>
			</view>
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				
			}
		},
		methods:{
			redirectPage(url) {
				uni.reLaunch({
					url
				})
			},
			navPage(url) {
				uni.navigateTo({
					url
				})
			},
			switUser(url){
				
				uni.setStorageSync('role','user')
				
				uni.switchTab({
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
	.tabbar {
		position: fixed;
		bottom: 0;
		left: 0;
		width: 750rpx;
		height: 160rpx;
		background-color: white;
		display: grid;
		grid-template-columns: repeat(4, 1fr);
	
		.item {
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			.icon {
				width: 56rpx;
				height: 56rpx;
			}
	
			.name {
				font-weight: bold;
				font-size: 20rpx;
				color: #999999;
			}
	
			.active {
				color: #BB4FE1;
			}
		}
	}
	.header{
		position: relative;
		// padding-left:30rpx ;
		// padding-right: 30rpx;
		.h-img{
			width: 750rpx;
			height: 548rpx;
		}
		.title{
			position: absolute;
			top: 108rpx;
			width: 750rpx;
			text-align: center;
		}
		.info{
			position: absolute;
			top:218rpx ;
			left: 30rpx;
			display: flex;
			align-items: center;
			.avatar{
				width:140rpx ;
				height: 140rpx;
				background-color: #666666;
				border-radius: 50%;
				image{
					width: 100%;
					height: 100%;
					border-radius: 50%;
				}
			}
			.user{
				margin-left: 30rpx;
				.name{
					font-weight: bold;
					font-size: 36rpx;
					color: #242424;
				}
				.tag{
					display: flex;
					flex-wrap: wrap;
					margin-top: 12rpx;
					.item{
						height: 32rpx;
						background-color: white;
						border-radius: 4rpx;
						margin-right: 10rpx;
						font-weight: 400;
						font-size: 20rpx;
						color: #7F6FDF;
						line-height: 32rpx;
						padding-left: 5rpx;
						padding-right: 5rpx;
					}
				}
				.id{
					font-weight: 400;
					font-size: 24rpx;
					color: #7C7C7C;
					margin-top: 18rpx;
				}
			}
		}
	
		.msg{
			position: absolute;
			top:398rpx;
			left: 30rpx;

			.item{
				height: 100rpx;
				width: 690rpx;
				background-color: white;
				border-bottom: 1px solid #f6f6f6;
				display: flex;
				align-items: center;
				justify-content: space-between;
				padding-left: 20rpx;
				padding-right: 20rpx;
				box-sizing: border-box;
				.left{
					display: flex;
					align-items: center;
					.l-icon{
						width: 40rpx;
						height: 40rpx;
					}
					.question{
						margin-left: 20rpx;
					}
					
				}
				.r-icon{
					width: 20rpx;
					height: 20rpx;
				}
			}
		}
		
		.msg1{
			position: absolute;
			top:718rpx;
			left: 30rpx;
		
			.item{
				height: 100rpx;
				width: 690rpx;
				background-color: white;
				border-bottom: 1px solid #f6f6f6;
				display: flex;
				align-items: center;
				justify-content: space-between;
				padding-left: 20rpx;
				padding-right: 20rpx;
				box-sizing: border-box;
				.left{
					display: flex;
					align-items: center;
					.l-icon{
						width: 20rpx;
						height: 20rpx;
					}
					.question{
						margin-left: 20rpx;
					}
					
				}
				.r-icon{
					width: 20rpx;
					height: 20rpx;
				}
			}
		}
	}
</style>

<style>
	page {
		background-color: #F6F6F6;
		/* 这里设置你想要的背景颜色 */
		padding: 0 0;
	}
</style>