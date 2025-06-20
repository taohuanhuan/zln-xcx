<template>
        <view class="container">
                <view class="profile-btn" @click="goProfile">
                        <u-icon name="account-fill" size="28" color="#BB4FE1" />
                </view>
                <!-- 标题：显示用户名和今日用药提醒 -->

		<view v-if="reminders.length > 0">
			<view class="header-title">{{ userName }} 今日用药提醒</view>
			<!-- 日期单独一行 -->
			<view class="header-date">{{ today }}</view>

			<!-- 提醒列表 -->
			<view class="reminder-list">
				<view class="reminder-item" v-for="(item, index) in reminders" :key="index">
					<view class="time-name">
						<text class="icon">🔔</text>
						<text class="time">{{ item.time }}</text>
						<text class="name">{{ item.name }}（{{ item.dosage }}）</text>
					</view>
					<view class="btn-wrap">
						<button v-if="item.status === 'pending'" class="confirm-btn" @click="confirm(item)">待服药</button>
						<button v-else class="done-btn" disabled>已服药</button>
					</view>
				</view>
				<!-- 列表底部：总条数 -->
				<view class="count">共 {{ reminders.length }} 条提醒</view>
			</view>
		</view>
		<view v-else class="empty-placeholder">

			<u-button @click="openAdd" color="#BB4FE1">暂无提醒，立即添加</u-button>
		</view>

		<!-- 悬浮添加按钮 -->
		<button class="add-btn" @click="openAdd">
			<u-icon name="plus" color="#ffffff" size="28" />
		</button>
	</view>
</template>

<script>
	import {
		wxLogin,
		todayList,
		reminderMark,
		Test
	} from '@/config/api' // 根据实际路径调整

	export default {
		data() {
			return {
				reminders: [{
						time: '07:00',
						name: '复方氨酚烷胺片',
						dosage: '1片',
						status: 'pending'
					},
					{
						time: '12:00',
						name: '降压药',
						dosage: '1片',
						status: 'pending'
					},
					{
						time: '18:00',
						name: '降糖药',
						dosage: '1片',
						status: 'pending'
					}
				]
			};
		},
		computed: {
			today() {
				const d = new Date();
				const M = String(d.getMonth() + 1).padStart(2, '0');
				const D = String(d.getDate()).padStart(2, '0');
				return `${d.getFullYear()}-${M}-${D}`;
			}

		},
		onShow() {
			this.login(),
				this.getTodayList(),
				this.Test()
		},
		methods: {

			async getTodayList() {
				const res = await todayList()
				if (res.code === 1 && Array.isArray(res.data)) {
					// 将后端返回的数据映射为 template 所需结构
					this.reminders = res.data.map(item => ({
						time: item.time.slice(0, 5), // "08:00:00" → "08:00"
						name: item.name || '',
						id: item.id,
						dosage: item.dosage,
						status: item.status === 1 ? 'pending' : 'done'
					}))
				} else {
					uni.showToast({
						title: res.msg || '获取提醒失败',
						icon: 'none'
					})
				}
			},

			async Test() {
				const p = {
					openid: "TEST_OPENID",
					template_id: "TEMPLATE_ID",
					page: "pages/index/index",
					data: {
						"foo": "bar"
					},
					send_time: "2025-05-23 11:22:00"
				}
				const res = await Test(p)
				console.log(JSON.stringify(res))
			},

			login() {
				wx.login({
					success: res => {
						if (res.code) {
							console.log('登录返回', res.code);
							wxLogin({
									code: res.code
								})
								.then(resp => {
									console.log('登录返回', resp);
									uni.setStorageSync('userinfo', {
										token: resp.data.token,
										user: resp.data.user
									})
									console.log('登录返回0', uni.getStorageSync('userinfo'));

									uni.showToast({
										title: '登录成功',
										icon: 'success'
									});
								})
								.catch(err => {
									console.error('登录失败', err);
									uni.showToast({
										title: '登录失败，请重试',
										icon: 'none'
									});
								});
						} else {
							uni.showToast({
								title: '获取 code 失败',
								icon: 'none'
							});
						}
					},
					fail: () => {
						uni.showToast({
							title: '登录调起失败',
							icon: 'none'
						});
					}
				});
			},

			// 跳转到添加记录页面
                        openAdd() {
                                uni.navigateTo({
                                        url: '/pages/index/add_record'
                                });
                        },
                        goProfile() {
                                uni.navigateTo({
                                        url: '/pages/profile/profile'
                                })
                        },
			// 确认已服药
			async confirm(item) {
				// 调用 reminderMark 接口，将这条提醒标记为“已服药”
				console.log(JSON.stringify(item))
				try {
					const res = await reminderMark({
						timeId: item.id,
						status: 0 // status=0 表示已服药
					});
					if (res.code === 1) {
						item.status = 'done';
						uni.showToast({
							title: '已服药',
							icon: 'success'
						});
					} else {
						uni.showToast({
							title: res.msg || '更新失败',
							icon: 'none'
						});
					}
				} catch (err) {
					uni.showToast({
						title: '网络错误，请稍后重试',
						icon: 'none'
					});
				}
			},

		}
	};
</script>

<style scoped>
	.container {
		height: 100vh;
		padding: 30rpx;
		/* background: linear-gradient(to bottom, #EEB3FA 0%, #f6f6f6 30%); */
	}

	/* 标题样式 */
	.header-title {
		text-align: center;
		font-size: 48rpx;
		font-weight: bold;
		color: #BB4FE1;
		margin-bottom: 10rpx;
	}

	.header-date {
		text-align: center;
		font-size: 48rpx;
		font-weight: bold;
		color: #BB4FEe;
		margin-bottom: 20rpx;
	}

	/* 提醒列表 */
	.reminder-list {
		background-color: #fff;
		border-radius: 16rpx;
		padding: 20rpx;
		margin-bottom: 20rpx;
	}

	.reminder-item {
		display: flex;
		justify-content: space-between;
		align-items: center;
		padding: 16rpx 0;
		border-bottom: 1rpx solid #f0f0f0;
	}

	.time-name {
		display: flex;
		align-items: center;
	}

	.icon {
		font-size: 40rpx;
		margin-right: 10rpx;
	}

	.time {
		font-size: 40rpx;
		font-weight: bold;
		margin-right: 10rpx;
	}

	.name {
		font-size: 38rpx;
		color: #555;
	}

	.btn-wrap {
		display: flex;
		align-items: center;
	}

	.confirm-btn,
	.done-btn {
		font-size: 34rpx;
		border-radius: 12rpx;
		padding: 12rpx 24rpx;
	}

	.confirm-btn {
		color: #fff;
		background-color: #BB4FE1;
		border: none;
	}

	.done-btn {
		color: #999;
		background-color: #f0f0f0;
		border: none;
	}

	.count {
		text-align: right;
		font-size: 32rpx;
		color: #999;
		margin-top: 10rpx;
	}

	/* 添加按钮 */
        .add-btn {
                position: fixed;
                right: 30rpx;
                bottom: 30rpx;
                width: 80rpx;
                height: 80rpx;
                background-color: #BB4FE1;
                border-radius: 40rpx;
                display: flex;
                justify-content: center;
                align-items: center;
        }

        .profile-btn {
                position: fixed;
                top: 20rpx;
                right: 20rpx;
        }
</style>