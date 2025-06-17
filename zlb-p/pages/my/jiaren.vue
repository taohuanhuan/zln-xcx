<template>
	<view>
		<view class="card">
			<view class="left">
				<view class="user">
					<view class="name">周伯通</view>
					<view class="tag">默认</view>
				</view>
				<view class="phone">13151627365</view>
			</view>

			<view class="right">
				<view class="btn edit">编辑</view>
				<view class="btn del">删除</view>
			</view>
		</view>
		
		<view class="btn-group">
			<view @click="navPage('/pages/my/jiarentianjia')" class="btn">新增</view>
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
			navPage(url){
				uni.navigateTo({
					url
				})
			}
		}
	}
</script>

<style scoped lang="scss">
	.card {
		padding: 30rpx;
		box-sizing: border-box;
		background-color: white;
		border-radius: 16rpx;

		display: flex;
		justify-content: space-between;
		align-items: end;

		.left {
			.user {
				display: flex;

				.name {
					font-weight: bold;
					font-size: 30rpx;
					color: #242424;
					margin-right: 10rpx;
				}

				.tag {
					width: 60rpx;
					height: 36rpx;
					background: #FFEFE8;
					border-radius: 2rpx;
					font-weight: 400;
					font-size: 20rpx;
					color: #FF6937;
					text-align: center;
					line-height: 36rpx;
				}

			}

			.phone {
				font-weight: 400;
				font-size: 28rpx;
				color: #242424;
				margin-top: 20rpx;
			}
		}

		.right {
			display: flex;

			.btn {
				width: 108rpx;
				height: 52rpx;
				border-radius: 30rpx;
				margin-right: 20rpx;
				line-height: 52rpx;
				text-align: center;
				font-weight: 400;
				font-size: 24rpx;
			}

			.edit {
				border: 2rpx solid #AE38D7;
				color: #AE38D7;
			}

			.del {

				border: 2rpx solid #F94248;
				color: #F94248;
			}
		}
	}
	.btn-group{
		position: fixed;
		bottom: 50rpx;
		left: 30rpx;
		.btn{
			width: 690rpx;
			height: 88rpx;
			line-height: 88rpx;
			text-align: center;
			background: linear-gradient( 90deg, #D275F2 0%, #AE38D7 100%);
			border-radius: 44rpx;
			font-weight: bold;
			font-size: 28rpx;
			color: #FFFFFF;
		}
	}
	
</style>