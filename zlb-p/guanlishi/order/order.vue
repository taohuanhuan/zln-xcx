<template>
	<view>
		<view style="background-color: white;">
			<view style="height:108rpx ;"></view>
			<view style="text-align: center;font-weight: 600;
		font-size: 34rpx;
		color: #242424;">订单</view>
			<view style="height: 30rpx;"></view>
		</view>
		<view class="main">

			<view class="panle">
				<view class="top">
					<view class="title">订单数据</view>
					<view class="se">
						<view class="se_title" @click="show=true">时间筛选</view>
						<image class="se-img" src="../../static/img/jiantou-d.png"></image>
					</view>

				</view>
				<view class="btn-group">
					<template v-for="item in dateList">
						<view class="btn " :class="date==item.id?'active':''" @click="changeDate(item.id)">
							{{item.title}}
						</view>
					</template>


				</view>
				<view class="data">
					<view class="item">
						<view class="top">12</view>
						<view class="bottom">待处理</view>
					</view>
					<view class="item">
						<view class="top">12</view>
						<view class="bottom">已完成</view>
					</view>
					<view class="item">
						<view class="top">12.00</view>
						<view class="bottom">预计总收入</view>
					</view>
					<view class="item">
						<view class="top">12.00</view>
						<view class="bottom">累计总收入</view>
					</view>

				</view>
			</view>
			<view class="panle-all">
				<view class="top">
					<view class="title">订单列表</view>
					<view class="se-group">
						<view class="se" @click="navPage('/guanlishi/user/yuyue_user')">
							<view class="se_title">用户筛选</view>
							<image class="se-img" src="../../static/img/jiantou-d.png"></image>
						</view>
						<view class="se">
							<view class="se_title" @click="show=true">时间筛选</view>
							<image class="se-img" src="../../static/img/jiantou-d.png"></image>
						</view>
					</view>

				</view>
				<view class="btn-group">
					<template v-for="item in tabs">
						<view class="btn " :class="active==item.id?'active':''" @click="changeTab(item.id)">{{item.title}}</view>
					</template>

				</view>
			</view>
			<view class="card" v-for="item in list"
				@click="navOrder(item.status, item.status ==1 ? '/guanlishi/order/detail_online' : '/guanlishi/order/order_finish')">
				<view class="top">
					<view class="num">4944979705557980981</view>
					<view class="status">线上</view>
				</view>
				<view class="c-main">
					<image class="img" src="../../static/img/avatar.png"></image>
					<view class="info">
						<view class="name mb">萌善治</view>
						<view class="i-title mb">我是服务项目名称 | 08:00-09:00</view>
						<view class="price mb">
							<view>¥2383.00</view>
							<view class="right">
								<view class="r-title">预计收入</view>
								<view class="r-price">¥2383.00</view>
							</view>
						</view>
					</view>


				</view>
				<view class="drive"></view>
				<view class="create-time">2024.05.01 09:34:22</view>

			</view>
			<view class="tabbar">
				<view class="item" @click="redirectPage('/guanlishi/index/index')">
					<image class="icon" src="/static/tab/index.png"></image>
					<view class="name ">首页</view>
				</view>
				<view class="item" @click="redirectPage('/guanlishi/order/order')">
					<image class="icon" src="/static/tab/order_s.png"></image>
					<view class="name active">订单</view>
				</view>
				<view class="item" @click="redirectPage('/guanlishi/message/message')">
					<image class="icon" src="/static/tab/message.png"></image>
					<view class="name">消息</view>
				</view>
				<view class="item" @click="redirectPage('/guanlishi/mine/mine')">
					<image class="icon" src="/static/tab/mine.png"></image>
					<view class="name">我的</view>
				</view>
			</view>
		</view>
		<u-datetime-picker
		                :show="show"
		                v-model="value1"
		                mode="date"
						@change="show=false"
						@close="show=false"
						@cancel="show=false"
						@confirm="show=false"
		        ></u-datetime-picker>
	</view>

</template>

<script>
	export default {
		data() {
			return {
				show:false,
				date: 0,
				dateList: [{
						id: 0,
						title: '今日'
					},
					{
						id: 2,
						title: '本周'
					},
					{
						id: 3,
						title: '本月'
					}
				],
				tabs: [{
						id: 1,
						title: '全部'
					},
					{
						id: 2,
						title: '待处理'
					},
					{
						id: 3,
						title: '已完成'
					}
				],
				active: 1,
				list: [{
						status: 1,
					},
					{
						status: 2,
					},
				]
			}
		},
		onLoad() {
				console.log(Date.now())
		},
		methods: {
			redirectPage(url) {
				uni.reLaunch({
					url
				})
			},
			changeDate(id) {
				this.date = id
			},
			navPage(url) {
				uni.navigateTo({
					url
				})
			},
			changeTab(idx) {
				switch (idx) {
					case 1:
						this.list = [{
								status: 1,
							},
							{
								status: 2,
							},
						];
						break;
					case 2:
						this.list = [{
							status: 1,
						}];
						break;
					case 3:
						this.list = [{
							status: 2,
						}, ];
						break;
				}
				this.active = idx
			},
			navOrder(status, url) {
				switch (status) {
					case 1:
						uni.navigateTo({
							url
						});
						break;
					case 2:
						uni.navigateTo({
							url
						});
						break;
				}
			}
		}
	}
</script>

<style lang="scss" scoped>
	.tabbar {
		position: fixed;
		bottom: 0;
		left: 0;
		width: 750rpx;
		height: 160rpx;
		background-color: white;
		display: grid;
		grid-template-columns: repeat(4, 1fr);

		.item {
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;

			.icon {
				width: 56rpx;
				height: 56rpx;
			}

			.name {
				font-weight: bold;
				font-size: 20rpx;
				color: #999999;
			}

			.active {
				color: #BB4FE1;
			}
		}
	}

	.main {
		padding: 30rpx;
		min-height: 100vh;
		background-color: #F6F6F6;

		.panle {
			width: 690rpx;
			height: 410rpx;
			background-color: white;
			border-radius: 16rpx;
			box-sizing: border-box;
			padding: 30rpx;

			.top {
				display: flex;
				justify-content: space-between;

				.title {
					font-weight: bold;
					font-size: 32rpx;
					color: #242424;
				}

				.se {
					display: flex;
					align-items: center;

					.se_title {
						font-weight: 400;
						font-size: 24rpx;
						color: #666666;
						margin-right: 10rpx;
					}

					.se-img {
						width: 40rpx;
						height: 40rpx;
					}
				}
			}

			.btn-group {
				display: flex;
				margin-top: 30rpx;

				.btn {
					width: 96rpx;
					height: 52rpx;
					background: #F6F6F6;
					border-radius: 10rpx;
					text-align: center;
					line-height: 52rpx;
					font-weight: 400;
					font-size: 28rpx;
					color: #666666;
					margin-right: 30rpx;
				}

				.active {
					background: linear-gradient(90deg, #D275F2 0%, #AE38D7 100%);
					color: white;
				}
			}

			.data {
				display: grid;
				grid-template-columns: repeat(2, 1fr);
				row-gap: 40rpx;
				margin-top: 20rpx;

				.item {
					display: flex;
					flex-direction: column;
					align-items: center;
					justify-content: center;
					// margin-top: 30rpx;

					.top {
						font-weight: bold;
						font-size: 40rpx;
						color: #242424;
					}

					.bottom {
						font-weight: 400;
						font-size: 24rpx;
						color: #999999;
					}
				}

			}

		}

		.panle-all {
			width: 690rpx;
			height: 186rpx;
			margin-top: 20rpx;
			background-color: white;
			border-radius: 16rpx;
			box-sizing: border-box;
			padding: 30rpx;

			.top {
				display: flex;
				justify-content: space-between;

				.title {
					font-weight: bold;
					font-size: 32rpx;
					color: #242424;
				}

				.se-group {
					display: flex;

					.se {
						display: flex;
						align-items: center;
						margin-left: 30rpx;
						// justify-content: end;

						.se_title {
							font-weight: 400;
							font-size: 24rpx;
							color: #666666;
							margin-right: 10rpx;
						}

						.se-img {
							width: 40rpx;
							height: 40rpx;
						}
					}
				}
			}

			.btn-group {
				display: flex;
				margin-top: 30rpx;

				.btn {
					width: 96rpx;
					height: 52rpx;
					background: #F6F6F6;
					border-radius: 10rpx;
					text-align: center;
					line-height: 52rpx;
					font-weight: 400;
					font-size: 28rpx;
					color: #666666;
					margin-right: 30rpx;
				}

				.active {
					background: linear-gradient(90deg, #D275F2 0%, #AE38D7 100%);
					color: white;
				}
			}

			.data {
				column-count: 2;

				.item {
					display: flex;
					flex-direction: column;
					align-items: center;
					justify-content: center;
					margin-top: 30rpx;

					.top {
						font-weight: bold;
						font-size: 40rpx;
						color: #242424;
					}

					.bottom {
						font-weight: 400;
						font-size: 24rpx;
						color: #999999;
					}
				}

			}

		}

		.card {
			margin-top: 20rpx;
			width: 690rpx;
			// height: 406rpx;
			box-sizing: border-box;
			padding: 30rpx;
			background-color: white;
			border-radius: 16rpx;

			.top {
				display: flex;
				justify-content: space-between;

				.num {
					font-weight: 400;
					font-size: 28rpx;
					color: #242424;
				}

				.status {
					color: #666666;
					font-weight: 400;
					font-size: 28rpx;
				}
			}

			.c-main {
				display: flex;
				margin-top: 20rpx;

				.img {
					width: 120rpx;
					height: 120rpx;
					border-radius: 50%;
					background-color: #242424;
					flex-shrink: 0;
				}

				.info {
					display: flex;
					margin-left: 20rpx;
					flex-direction: column;
					justify-content: space-between;

					.name {
						font-weight: bold;
						font-size: 30rpx;
						color: #242424;
					}

					.i-title {
						// width: 192rpx;
						font-family: PingFangSC, PingFang SC;
						font-weight: 400;
						font-size: 24rpx;
						color: #666666;
						line-height: 34rpx;
						text-align: left;
						font-style: normal;
					}

					.time {
						width: 460rpx;
						height: 34rpx;
						font-family: PingFangSC, PingFang SC;
						font-weight: 400;
						font-size: 24rpx;
						color: #666666;
						line-height: 34rpx;
						text-align: left;
						font-style: normal;
					}

					.price {
						width: 508rpx;
						display: flex;
						justify-content: space-between;
						font-family: PingFang-SC, PingFang-SC;
						font-weight: bold;
						font-size: 24rpx;
						color: #E62626;
						line-height: 34rpx;
						text-align: left;
						font-style: normal;

						.right {
							display: flex;

							.r-title {
								color: #666666;
								padding-right: 10rpx;
							}
						}
					}

					.mb {
						margin-bottom: 20rpx;
					}
				}
			}

			.drive {
				height: 2rpx;
				width: 630rpx;
				margin-left: 30rpx;
				background-color: #F6F6F6;
				margin-bottom: 20rpx;
			}

			.create-time {
				font-weight: 400;
				font-size: 28rpx;
				color: #666666;
			}
		}
	}
</style>

<style>
	page {
		background-color: #F6F6F6;
		/* 这里设置你想要的背景颜色 */
		padding: 0 0;
	}
</style>