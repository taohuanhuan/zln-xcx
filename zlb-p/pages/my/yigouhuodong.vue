<template>
	<view style="width: 690rpx;
		margin: 0 -30rpx;padding-bottom: 30rpx;" >
		<view class="header">
			<view class="btn-group">
				<view class="btn active">
					全部
					<view class="line"></view>
				</view>
				<view class="btn">待使用</view>
				<view class="btn">已使用</view>
				<view class="btn">已过期</view>
			</view>
		</view>
		<view class="card" v-for="item in 5">
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
	page {
	  background-color: #F6F6F6; /* 这里设置你想要的背景颜色 */
	  padding: 0 0rpx;
	}
	.header {
		height: 100rpx;
		background-color: white;
		display: flex;
		justify-content: space-between;
		align-items: center;
		padding-left: 60rpx;
		padding-right: 30rpx;
		font-weight: 400;
		font-size: 28rpx;
		color: #666666;

		.btn-group {
			display: flex;
			justify-content: space-between;
			align-items: center;
			width: 690rpx;
			.btn {
				// margin-right: 114rpx;
			}

			.active {
				font-weight: bold;
				font-size: 32rpx;
				color: #242424;

				.line {
					content: "";
					width: 64rpx;
					height: 12rpx;
					background: #C871E7;
					border-radius: 6rpx;
				}

			}
		}
	}
	
	.card{
		width: 690rpx;
		margin-left: 30rpx;
		padding: 30rpx;
		box-sizing: border-box;
		background-color: white;
		margin-top: 30rpx;
		.top{
			display: flex;
			justify-content: space-between;
			align-items: center;
			.title{
				font-weight: bold;
				font-size: 30rpx;
				color: #242424;
			}
			.status{
				font-weight: 400;
				font-size: 28rpx;
				color: #666666;
			}
		}
		.middle{
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin: 20rpx 0;
			
			.left{
				
				.price{
					font-weight: bold;
					font-size: 24rpx;
					color: #E62626;
					margin: 10rpx 0 20rpx 0;
					
				}
				.expire{
					font-weight: 400;
					font-size: 24rpx;
					color: #666666;
					
				}
			}
			.diff{
				font-weight: 400;
				font-size: 24rpx;
				color: #242424;
			}
		}
		.bottom{
			display: flex;
			justify-content: space-between;
			align-items: end;
			.time{
				font-weight: 400;
				font-size: 24rpx;
				color: #999999;
			}
			.btn{
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
	}
</style>