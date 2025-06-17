<template>
  <view style="width: 690rpx; margin: 0 -30rpx; padding-bottom: 30rpx;">
    <view class="header">
      <view class="btn-group">
        <view v-for="(item) in menu" :key="item.id" class="btn" :class="active === item.id ? 'active' : ''"
          @click="changeTab(item.id)">
          {{ item.title }}
          <template v-if="active === item.id">
            <view class="line"></view>
          </template>
        </view>
      </view>
    </view>
    <view class="card" v-for="item in list" :key="item.activity_id">
      <view class="top">
        <view class="title">{{ item.activity_title }}</view>
        <view class="status">
          {{ item.activity_status === '1' ? '待使用' : (item.activity_status === '2' ? '已过期' : '已使用') }}
        </view>
      </view>
      <view class="middle">
        <view class="left">
          <view class="price">￥{{ item.activity.activity_price }}</view>
          <view class="expire">有效期：{{ item.activity.period_validity }}</view>
          <view class="expire">订单编号：{{ item.order_code }}</view>
          <view class="expire">下单商家：{{ item.activity.clinic_id_text }}</view>
        </view>
        <view class="diff">剩余可用次数：{{ item.use_count }}</view>
      </view>
      <view class="bottom">
        <view class="time"></view>
        <view class="btn" @click="changePage">去使用</view>
      </view>
    </view>
  </view>
</template>


<script>
	import {
		getYhMineActivity
	} from '@/config/api.js'; // 请根据你的实际路径进行调整

	export default {
		data() {
			return {
				menu: [{
						id: 0,
						title: '全部',
						activity_status: '0'
					},
					{
						id: 1,
						title: '待使用',
						activity_status: '1'
					},
					{
						id: 2,
						title: '已使用',
						activity_status: '3'
					},
					{
						id: 3,
						title: '已过期',
						activity_status: '2'
					}
				],
				active: 0,
				list: [] // 用于存储活动列表的数据
			};
		},
		methods: {
			changeTab(id) {
				this.active = id;
				this.getActivityList();
			},
			// 获取活动列表的方法
			getActivityList() {
				const selectedMenu = this.menu.find(item => item.id === this.active);
				const params = {
					activity_status: selectedMenu ? selectedMenu.activity_status : '0'
				};
				getYhMineActivity(params)
					.then(response => {
						this.list = response;
						console.log(JSON.stringify(this.list))
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
		},
		mounted() {
			// 页面加载时获取初始数据
			this.getActivityList();
		}
	};
</script>

<style lang="scss" scoped>
	page {
		background-color: #F6F6F6;
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
		margin-left: 30rpx;
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
			margin: 20rpx 0;

			.left {
				.price {
					font-weight: bold;
					font-size: 24rpx;
					color: #E62626;
					margin: 10rpx 0 20rpx 0;
				}

				.expire {
					font-weight: 400;
					font-size: 24rpx;
					color: #666666;
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