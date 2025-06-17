<template>
	<view>
		<!-- 优惠券卡片 -->
		<view class="card">
			<view class="top">
				<view class="title">{{ couponDetail.coupon_title || '优惠券标题' }}</view>
				<template v-if="status == 1">
					<view class="status">待使用</view>
				</template>
				<template v-if="status == 2">
					<view class="status">已过期</view>
				</template>
				<template v-if="status == 3">
					<view class="status">已使用</view>
				</template>
			</view>
			<view class="middle">
				<view class="left">
					<view class="expire">
						有效期：{{ couponDetail.begin_period_validity }}～{{ couponDetail.end_period_validity }}
					</view>
				</view>
			</view>
			<view class="bottom" style="margin-top: 30rpx;">
				<view class="time"></view>
				<template v-if="status == 1">
					<view class="btn" @click="changePage">去使用</view>
				</template>
			</view>
		</view>

		<!-- 优惠券明细卡片 -->
		<view class="card">
			<view class="top">
				<view class="title">明细</view>
			</view>
			<view class="list">
				<view class="order">
					<view class="title">领取时间</view>
					<view class="desc">{{ couponDetail.createdtime_text }}</view>
				</view>
				<view class="order">
					<view class="title">使用时间</view>
					<view class="desc">{{ couponDetail.use_time || '未使用' }}</view>
				</view>
				<view class="order">
					<view class="title">订单编号</view>
					<view class="desc">{{ couponDetail.coupon_id }}</view>
				</view>
			</view>
		</view>

		<!-- 使用说明卡片 -->
		<view class="card">
			<view class="top">
				<view class="title">使用说明</view>
			</view>
			<view class="shuoming">
				<view class="desc" v-html="couponDetail.coupon_content || '暂无说明'"></view>
			</view>
		</view>
	</view>
</template>

<script>
	import {
		getMineCouponDetail
	} from '@/config/api.js'; // 请根据你的实际路径调整

	export default {
		data() {
			return {
				status: 1,
				couponDetail: {} // 用于存储优惠券详情数据
			};
		},
		onLoad(options) {
			this.status = options.status;
			this.user_coupon_id = options.status;
			this.getCouponDetail(); // 加载页面时请求优惠券详情
		},
		methods: {
			getCouponDetail() {
				const params = {
					user_coupon_id: this.user_coupon_id
				};
				getMineCouponDetail(params)
					.then(response => {

						this.couponDetail = response;

					})
					.catch(error => {
						console.error('请求失败:', error);
					});
			},
			changePage() {
				uni.navigateTo({
					url: '/pages/supervision/consultation_center'
				});
			}
		}
	};
</script>


<style lang="scss" scoped>
	.order {
		display: flex;
		margin-top: 20rpx;

		.title {
			width: 160rpx;
			font-weight: 400;
			font-size: 28rpx;
			color: #666666;

		}

		.desc {
			font-weight: 400;
			font-size: 28rpx;
			color: #242424;
		}
	}

	.drive {
		width: 630rpx;
		height: 2rpx;
		background: #F6F6F6;
		margin: 30rpx 0;
	}

	.card {
		width: 690rpx;
		// margin-left: 30rpx;
		padding: 30rpx;
		box-sizing: border-box;
		background-color: white;
		margin-top: 30rpx;
		border-radius: 16rpx;

		.top {
			display: flex;
			justify-content: space-between;
			align-items: center;

			.title {
				font-weight: bold;
				font-size: 30rpx;
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

		.shuoming {
			.title {
				font-weight: bold;
				font-size: 24rpx;
				color: #242424;
				line-height: 34rpx
			}

			.desc {
				font-weight: 400;
				font-size: 24rpx;
				color: #666666;
				margin-top: 30rpx;
			}
		}
	}
</style>