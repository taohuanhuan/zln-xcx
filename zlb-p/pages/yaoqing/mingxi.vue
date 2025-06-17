<template>
	<view>
		<view class="card">
			<view class="item" v-for="item in 5">
				<view class="top">
					<view class="">4944979705557980981</view>
					<view class="">2024.05.05 09:34</view>
				</view>
				<view class="bottom">
					<view class="user">
						<view class="name">黄蓉</view>
						<view class="status">二级返佣</view>
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
	.card {
		padding: 30rpx;
		box-sizing: border-box;
		background-color: white;
		.item{
			width: 690rpx;
			height: 132rpx;
			border-bottom: 1px solid #F6F6F6;
			.top{
				width: 630rpx;
				display: flex;
				justify-content: space-between;
				font-weight: 400;
				font-size: 28rpx;
				color: #666666;
			}
			.bottom{
				margin-top: 20rpx;
				.user{
					display: flex;
					.name{
						font-weight: 400;
						font-size: 28rpx;
						color: #242424;
					}
					.status{
						font-weight: 400;
						font-size: 28rpx;
						color: #666666;
						margin-left: 20rpx;
					}
				}
			}
		}
	}
</style>