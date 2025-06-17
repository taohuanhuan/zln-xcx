<template>
	<view>
		<view class="main">
			<image class="avatar" src="../static/img/avatar.png"></image>
			<view class="info">
				<view class="title">{{title}}</view>
				<view class="desc">{{desc}}
					<view class="jiantou">
						<image class="icon" src="../static/img/jiantou-r.png"></image>
					</view>
				</view>
			</view>
		</view>
	</view>
</template>

<script>
	export default {
		name: "dangwei",
		data() {
			return {

			};
		},
		props: {
			title: {
				type: String,
				default: ''
			},
			desc: {
				type: String,
				default: ''
			}

		}
	}
</script>

<style lang="scss" scoped>
	.main {
		width: 690rpx;
		height: 184rpx;
		background: #FFFFFF;
		border-radius: 16rpx;
		padding: 30rpx;
		display: flex;
		box-sizing: border-box;
		align-items: center;

		.avatar {
			width: 100rpx;
			height: 100rpx;
		}

		.info {
			display: flex;
			width: 508rpx;
			flex-direction: column;
			margin-left: 22rpx;
			height: 90rpx;
			justify-content: space-between;

			.title {
				font-weight: bold;
				font-size: 28rpx;
				color: #242424;
			}

			.desc {
				font-weight: 400;
				font-size: 24rpx;
				color: #242424;
				margin-top: 16rpx;
				.jiantou{
					display: inline-block;
					.icon{
						width: 20rpx;
						height:20rpx;
					}
				}
			}
		}
	}
</style>