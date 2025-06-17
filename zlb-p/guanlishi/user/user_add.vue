<template>
	<view class="main">
		<view class="card">
			<view class="title">基本信息</view>
			<view class="item">
				<view class="left">姓名</view>
				<view class="right">
					<input placeholder="请输入姓名" />
				</view>
			</view>
			<view class="item">
				<view class="left">联系方式</view>
				<view class="right">
					<input placeholder="请输入联系方式" />
				</view>
			</view>
			<view class="item">
				<view class="left">性别</view>
				<view class="right">
					<u-radio-group v-model="value" placement="row">
						<u-radio activeColor="#AE38D7" label="男"></u-radio>
						<u-radio activeColor="#AE38D7" label="女"></u-radio>
					</u-radio-group>
				</view>
			</view>
			<view class="item">
				<view class="left">年龄</view>
				<view class="right">
					<input placeholder="请输入年龄" />
				</view>
			</view>

		</view>
		<view class="btn">确认新增</view>

	</view>
</template>

<script>
	export default {
		data() {
			return {
				// value: '男'
			};
		},
		
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
					input {
						text-align: right;
						font-size: 28rpx;
						color: #999999;
					}
				}

			}
		}

	}

	.btn {
		position: fixed;
		bottom: 50rpx;
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