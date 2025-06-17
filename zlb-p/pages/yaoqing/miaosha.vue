<template>
	<view>
		<view class="search">
		
			<u-search placeholder="请输入关键词搜索查询" v-model="keyword" :show-action="false"></u-search>
		
		</view>
		

		<view class="main">
			<view class="tab">
				<view class="btn active">
					线上
					<view class="line"></view>
				</view>
				<view class="btn">线下</view>
			</view>

			<view class="card" v-for="iten in 5">
				<image class="img" src="../../static/temp/avatar.png"></image>
				<view class="right">
					<view class="title">未来世界生存法则：李松蔚认知思维16讲</view>
					<view class="middle">
						<view class="tags">
							<view class="tag">新课首发</view>
							<view class="tag">新课首发</view>
						</view>
						<view class="status">线上</view>
					</view>
					<view class="bottom">
						<view class="price">
							<view class="now">￥39.9</view>
							<view class="old">￥69.9</view>
						</view>
						<view class="time">2天05:21:12</view>
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
	page {
		background-color: #F6F6F6;
		/* 这里设置你想要的背景颜色 */
		padding: 0 0;
	}

	.main {
		padding: 30rpx;
		background-color: white;
		box-sizing: border-box;

		.tab {
			width: 750rpx;
			height: 80rpx;
			background-color: white;
			display: flex;

			.btn {
				position: relative;
				margin-right: 80rpx;
				font-weight: 400;
				font-size: 28rpx;
				color: #666666;

				.line {
					position: absolute;
					width: 56rpx;
					height: 4rpx;
					background: #C871E7;
					border-radius: 6rpx;
					top: 56rpx;
				}
			}

			.active {
				font-weight: bold;
				font-size: 28rpx;
				color: #242424;
			}
		}
	}

	.card {
		display: flex;
		margin-top: 30rpx;
		height: 236rpx;
		border-bottom: 1px solid #F6F6F6;
		.img {
			width: 160rpx;
			height: 160rpx;
			border-radius: 10rpx;
		}

		.right {
			margin-left: 20rpx;

			.title {
				font-weight: bold;
				font-size: 30rpx;
				color: #242424;
			}

			.middle {
				display: flex;
				justify-content: space-between;
				.tags {
					display: flex;

					.tag {
						height: 36rpx;
						background: #FFEFE8;
						border-radius: 2rpx;
						font-weight: 400;
						font-size: 20rpx;
						color: #FF6937;
						margin-right: 10rpx;
						padding: 5rpx 10rpx;
						line-height: 36rpx;
					}
				}
				.status{
					font-weight: 400;
					font-size: 28rpx;
					color: #666666;
				}
			}

			.bottom{
				display: flex;
				justify-content: space-between;
				align-items: end;
				margin-top: 10rpx;
				.price{
					display: flex;
					.now{
						font-weight: bold;
						font-size: 24rpx;
						color: #E62626;
						margin-right: 10rpx;
					}
					.old{
						font-weight: 400;
						font-size: 24rpx;
						color: #999999;
						text-decoration: line-through;
					}
				}
				
				.time{
					width: 202rpx;
					height: 52rpx;
					background: #F2685C;
					border-radius: 32rpx;
					text-align: center;
					line-height: 52rpx;
					color: white;
				}
			}
		}
	}
	.search {
		// padding: 30rpx 30rpx 20rpx 30rpx;
		padding: 30rpx;
	}
</style>

<style>
	page{
		padding: 0;;
	}
</style>