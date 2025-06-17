<template>
	<view style="width: 690rpx;">
		<view class="header" style="margin: 0 -30rpx;">
			<view class="btn-group">
				<template v-for="(item) in menu">
					<view class="btn" :class="active == item.id ? 'active' : ''" @click="changeTab(item.id)"
						:key="item.id">
						{{item.title}}
						<template v-if="active == item.id">
							<view class="line"></view>
						</template>
					</view>
				</template>
			</view>
		</view>
		<view class="card" v-for="(item) in list" :key="item.user_coupon_id"
			@click="navPage('/pagesA/my/youhuiquan_xiangqing?status=' + item.user_coupon_id)">
			<view class="top">
				<view class="title" :class="item.coupon_status == '1' ? 'active' : ''">{{ item.coupon_title }}</view>
				<view class="status">
					{{ item.coupon_status == '1' ? '待使用' : (item.coupon_status == '2' ? '已过期' : '已使用') }}
				</view>
			</view>
			<view class="middle">
				<view class="left">
					<view class="expire">有效期：{{ item.begin_period_validity }} ～ {{ item.end_period_validity }}</view>
				</view>
			</view>
			<view class="bottom">
				<view class="" style="display: flex;">
					<view class="time">使用说明:</view>
					<view class="time" v-html="item.coupon_content"></view>
				</view>
				<template v-if="item.coupon_status == '1'">
					<view class="btn">去使用</view>
				</template>
			</view>
		</view>
	</view>
</template>

<script>
	import {
		getMineCoupon
	} from '@/config/api.js'; // 请根据你的实际路径进行调整

	export default {
		data() {
			return {
				menu: [{
						id: 0,
						title: '全部',
						coupon_status: 0
					},
					{
						id: 1,
						title: '待使用',
						coupon_status: 1
					},
					{
						id: 2,
						title: '已过期',
						coupon_status: 2
					},
					{
						id: 3,
						title: '已使用',
						coupon_status: 3
					}
				],
				active: 0,
				list: []
			};
		},
		methods: {
			changeTab(id) {
				this.active = id;
				this.getCoupons();
				// 获取数据
			},
			navPage(url) {
				uni.navigateTo({
					url
				})
			},
			// 获取优惠券的方法
			getCoupons() {
				const selectedMenu = this.menu.find(item => item.id === this.active);
				const params = {
					coupon_status: selectedMenu ? selectedMenu.coupon_status : '0', // 根据选中的menu项的coupon_status
				};
				getMineCoupon(params)
					.then(response => {
						// 假设返回的数据在response.data中
						this.list = response || [];
					})
					.catch(error => {
						console.error('获取优惠券失败:', error);
					});
			},
			navPage(url) {
				uni.navigateTo({
					url
				});
			}
		},
		mounted() {
			// 页面加载时获取初始数据
			this.getCoupons();
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
			margin-top: 20rpx;

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