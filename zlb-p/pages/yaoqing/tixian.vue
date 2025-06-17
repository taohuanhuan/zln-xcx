<template>
	<view>
		<view class="card">
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
					+86.00
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

		.item {
			width: 630rpx;
			height: 132rpx;
			border-bottom: 1px solid #F6F6F6;
			display: flex;
			justify-content: space-between;
			align-items: center;

			.left {
				height: 100rpx;
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
		}
	}
</style>