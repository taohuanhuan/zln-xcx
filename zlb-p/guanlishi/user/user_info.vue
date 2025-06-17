<template>
	<view>
		<view class="main">
			<view style="height: 20rpx;"></view>
			<view class="card">
				<view class="left">
					<image class="avatar" src="../../static/img/avatar.png"></image>
					<view class="user">
						<view class="name">宫琦</view>
						<view class="phone">152 **** 8890</view>
					</view>
				</view>
			<!-- 	<view class="right">
					<view class="text">
						用户信息
					</view>
					<image class="r-icon" src="../../static/img/jiantou-r.png"></image>
				</view> -->
			</view>

			<view class="question">
				<view class="q-detail">
					<view class="q-title">是否本人咨询</view>
					<view class="q-desc">宫琦</view>
				</view>
				<view class="q-detail">
					<view class="q-title">性别</view>
					<view class="q-desc">男</view>
				</view>
				<view class="q-detail">
					<view class="q-title">年龄</view>
					<view class="q-desc">36</view>
				</view>
				<view class="q-detail">
					<view class="q-title">个人档案</view>
					<view class="q-desc">
						<image src="../../static/img/switch-on.png"></image>
						隐私
						</view>
				</view>
				
				<view class="user-dangan">
					<view class="doc">用户档案信息.word</view>
					<view class="btn">下载</view>
				</view>
				
			</view>
			<view class="m-title">就诊记录</view>
			<view class="feiyong" @click="navPage('/guanlishi/user/jiuzhen_xiangqing')">
				<view class="item-header">
					<view class="title">就诊记录标题</view>
					<view class="update" @click="navPage('/guanlishi/user/jiuzhen_form')">更新记录 ></view>
				</view>
				<CCell title="就诊时长" desc="40分钟"></CCell>
				<CCell title="就诊时间" desc="2024.07.10 08:28——18"></CCell>
			</view>
		</view>
	</view>
</template>

<script>
	import CCell from '@/components/CCell.vue'
	export default {
		data() {
			return {

			};
		},
		components: {
			CCell
		},
		methods: {
			navPage(url) {
				uni.navigateTo({
					url
				})
			}
		}
	}
</script>

<style lang="scss" scoped>
	.title {
		font-weight: bold;
		font-size: 32rpx;
		color: #242424;
	}

	.m-title {
		font-weight: bold;
		font-size: 32rpx;
		color: #242424;
		margin-top: 30rpx;
	}

	.main {
		background-color: #F6F6F6;
		min-height: 100vh;
		padding-left: 30rpx;
		padding-right: 30rpx;

		.card {
			width: 690rpx;
			height: 132rpx;

			background-color: white;
			box-sizing: border-box;
			padding-left: 30rpx;
			padding-right: 30rpx;
			padding-top: 20rpx;
			display: flex;
			justify-content: space-between;
			border-radius: 16rpx;

			.left {
				display: flex;
				align-items: center;

				.avatar {
					width: 98rpx;
					height: 98rpx;
					border: 1rpx solid #C6C6C6;
					border-radius: 50%;
				}

				.user {
					// width: 180rpx;
					margin-left: 20rpx;

					.name {
						font-weight: bold;
						font-size: 28rpx;
						color: #242424;
					}

					.phone {
						font-weight: 400;
						font-size: 24rpx;
						color: #999999;
						margin-top: 10rpx;
					}
				}
			}

			.right {
				display: flex;
				align-items: center;

				.text {
					font-weight: 400;
					font-size: 24rpx;
					color: #242424;
				}

				.r-icon {
					width: 19rpx;
					height: 20rpx;
				}
			}

		}

		.question {
			width: 690rpx;
			margin-top: 20rpx;
			background-color: white;
			box-sizing: border-box;
			padding: 30rpx;
			border-radius: 16rpx;
			
			.q-detail{
				width: 630rpx;
				height: 80rpx;
				line-height: 80rpx;
				display: flex;
				justify-content: space-between;
				// background-color: red;
				.q-title{
					width: 180rpx;
					font-weight: 400;
					font-size: 28rpx;
					color: #666666;
					line-height: 80rpx;
					text-align: left;
				}
				.q-desc{
					display: flex;
					align-items: center;
					font-weight: 400;
					font-size: 28rpx;
					color: #242424;
					line-height: 80rpx;
					text-align: center;
					image{
						width: 74rpx;
						height: 40rpx;
						margin-right: 20rpx;
					}
				}
			}
		}

	}

	.feiyong {
		padding: 30rpx;
		box-sizing: border-box;
		background-color: white;
		margin-top: 20rpx;
		border-radius: 16rpx;
		.item-header{
			display: flex;
			align-items: end;
			justify-content: space-between;
	
			.update{
				font-weight: 400;
				font-size: 24rpx;
				color: #242424;
			}
		}
	}
	
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

<style>
	page {
		background-color: #F6F6F6;
		/* 这里设置你想要的背景颜色 */
		padding: 0 0;
	}
</style>