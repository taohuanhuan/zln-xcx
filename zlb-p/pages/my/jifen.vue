<template>
	<view style="	width: 690rpx;
		margin: 0 -30rpx;">
		<image class="avatar" src="../../static/img/shouru-bg.png"></image>
		<view class="main">
			<view class="">
				<view class="all">总积分</view>
				<view class="num">9800</view>
			</view>
			<view class="card">
				<viwe class="title">积分记录</viwe>
				<view class="item" v-for="item in 5">
					<view class="left">
						<view class="title">
							不难，要你干嘛？
						</view>
						<view class="time">
							2024.05.05 09:34
						</view>
					</view>
			
					<view class="right">
						+86
					</view>
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
	.uni-page-body{
		padding: 0;
	
	}
	
	.avatar{
		width: 750rpx;
		height: 400rpx;
	}
	
	.main {
		position: absolute;
		top:40rpx;
		padding-left: 30rpx;
		padding-right: 30rpx;
		padding-top: 20rpx;
		// background-color: #F6F6F6;
		min-height: 100vh;
		width: 690rpx;

		.all {
			font-weight: 400;
			font-size: 28rpx;
			color: #666666;
		}

		.num {
			font-weight: bold;
			font-size: 72rpx;
			color: #242424;
			margin-top: 20rpx;
			margin-bottom: 20rpx;

		}
		.card {
			padding: 30rpx;
			box-sizing: border-box;
			background-color: white;
			
			.title{
				font-weight: bold;
				font-size: 32rpx;
				color: #242424;
			}
		
			.item {
				width: 630rpx;
				height: 132rpx;
				border-bottom: 1px solid #F6F6F6;
				display: flex;
				justify-content: space-between;
				align-items: center;
				margin-top: 10rpx;
		
				.left {
					height: 90rpx;
					display: flex;
					flex-direction: column;
					justify-content: space-between;
					.title{
						font-weight: 400;
						font-size: 28rpx;
						color: #242424;
					}
					.time{
						font-weight: 400;
						font-size: 28rpx;
						color: #999999;
					}
				}
				
				.right{
					font-weight: bold;
					font-size: 28rpx;
					color: #AE38D7;
				}
			}
		}
	}
	
	.btn-group{
		position: fixed;
		bottom: 0;
		display: flex;
		justify-content: space-between;
		box-sizing: border-box;
		width: 750rpx;
		height: 166rpx;
		background: #FFFFFF;
		padding: 10rpx 40rpx 0 40rpx ;
		.btn{
			width: 320rpx;
			height: 88rpx;
			border-radius: 44rpx;
			border: 2rpx solid #AE38D7;
			line-height: 88rpx;
			text-align: center;
			font-weight: bold;
			font-size: 30rpx;
			color: #AE38D7;
		}
		.active{
			background: linear-gradient( 90deg, #D275F2 0%, #AE38D7 100%);
			color: white;
		}
	}
</style>