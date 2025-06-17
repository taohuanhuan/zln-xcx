<template>
	<view style="width: 690rpx;">
		<view class="header" style="margin: 0 -30rpx;">
			<view class="btn-group">
				<template v-for="(item) in menu" >
					<view class="btn " :class="active==item.id?'active':''" @click="changeTab(item.id)" :key="item.id">
						{{item.title}}
						<template v-if="active==item.id">
							<view class="line"></view>
						</template>
					</view>
				</template>

			</view>
		</view>
		<view class="card" v-for="(item) in list" @click="navPage('/pages/my/youhuiquan_xiangqing?status='+item.status)">
			<view class="top">
				<view class="title" :class="item.status==1?'active':''">3次限时7折</view>
				<view class="status">{{item.title}}</view>
			</view>
			<view class="middle">
				<view class="left">
					<view class="expire">有效期：2024.05.05～2024.06.05</view>
				</view>

			</view>
			<view class="middle">
				<view class="left">
					<view class="expire">2024.05.05～2024.06.05</view>
				</view>
			</view>

			<view class="bottom">
				<view class="time">使用说明 ></view>
				<template v-if="item.status==1">
					<view class="btn">去使用</view>
				</template>

			</view>
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				menu: [{
						id: 0,
						title: '全部'
					},
					{
						id: 1,
						title: '待使用'
					},
					{
						id: 2,
						title: '已过期'
					},
					{
						id: 3,
						title: '已使用'
					}
				],
				active: 0,
				list: [{
						status: 1,
						title: '待使用'
					}, {
						status: 2,
						title: '已过期'
					},
					{
						status: 3,
						title: '已使用'
					}
				]
			};
		},
		methods: {
			changeTab(id) {
				this.active = id;
				switch (id) {
					case 0:
						this.list = [{
								status: 1,
								title: '待使用'
							}, {
								status: 2,
								title: '已过期'
							},
							{
								status: 3,
								title: '已使用'
							}
						]
						break;
					case 1:
						this.list = [{
							status: 1,
							title: '待使用'
						}]
						break;
					case 2:
						this.list = [{
							status: 2,
							title: '已过期'
						}]
						break;
					case 3:
						this.list = [{
							status: 3,
							title: '已使用'
						}]
						break;
				}
			},
			navPage(url) {
				uni.navigateTo({
					url
				})
			}
		}
	}
</script>

<style lang="scss" scoped>
	page {
		background-color: #F6F6F6;
		/* 这里设置你想要的背景颜色 */
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

	.card {
		width: 690rpx;
		padding: 30rpx;
		box-sizing: border-box;
		background-color: white;
		margin-top: 30rpx;

		.top {
			display: flex;
			justify-content: space-between;
			align-items: center;

			.title {
				font-weight: bold;
				font-size: 30rpx;
				color: #666666;
			}

			.active {
				color: #242424;
			}

			.status {
				font-weight: 400;
				font-size: 28rpx;
				color: #666666;
			}
		}

		.middle {
			display: flex;
			justify-content: space-between;
			align-items: center;

			.left {

				.price {
					font-weight: bold;
					font-size: 24rpx;
					color: #E62626;
				}

				.expire {
					font-weight: 400;
					font-size: 24rpx;
					color: #666666;
					margin-top: 20rpx;
				}
			}

			.diff {
				font-weight: 400;
				font-size: 24rpx;
				color: #242424;
			}
		}

		.bottom {
			display: flex;
			justify-content: space-between;
			align-items: end;

			.time {
				font-weight: 400;
				font-size: 24rpx;
				color: #999999;
			}

			.btn {
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