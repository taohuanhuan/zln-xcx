<template>
	<view class="main">
		<view style="background-color: white;">
			<view style="height:108rpx ;"></view>
			<view style="text-align: center;font-weight: 600;
font-size: 34rpx;
color: #242424;">首页</view>
			<view style="height: 30rpx;"></view>
		</view>
		<view class="header">
			<view class="card" @click="navPage('/guanlishi/user/zixun_user')">
				<view class="top">
					<image class="t-img" src="../../static/img/zixunyonghu.png"></image>
					<view class="t-title">咨询用户管理</view>
				</view>
				<view class="detail">
					点击查看
				</view>
			</view>
			<view class=" card-active" @click="navPage('/guanlishi/user/yuyue')">
				<view class="top">
					<image class="t-img" src="../../static/img/yuyuexiaci.png"></image>
					<view class="t-title">预约下次咨询</view>
				</view>
				<view class="detail">
					点击查看
				</view>
			</view>
		</view>

		<view class="content">
			<view class="qj-title title">咨询信息</view>

			<view class="group-btn">
				<view class="btn " @click="changeTab(1)" :class="active===1 ?'active':''">
					全部
				</view>
				<view class="btn " @click="changeTab(2)" :class="active===2 ?'active':''">
					待处理
				</view>

				<view class="btn " @click="changeTab(3)" :class="active===3 ?'active':''">
					已完成
				</view>
			</view>


			<template v-for="(item,idx) in list">
				<view class="card"
					@click="navOrder(item.status, item.status ==1 ? '/guanlishi/order/detail_online' : '/guanlishi/order/order_finish')">
					<view class="top">
						<view class="num">4944979705557980981</view>
						<view class="status">线上</view>
					</view>
					<view class="c-main">
						<image class="img" src="../../static/img/avatar.png"></image>
						<view class="info">
							<view class="name mb">萌善治</view>
							<view class="i-title mb">我是服务项目名称</view>
							<view class="time mb">项目服务时间：2024.05.01 08：00-09:00</view>
							<view class="price mb">¥2383.00</view>
						</view>
					</view>
					<view class="drive"></view>
					<view class="create-time">2024.05.01 09:34:22</view>
				</view>
			</template>


		</view>

		<view class="tabbar">
			<view class="item">
				<image class="icon" src="/static/tab/index_s.png"></image>
				<view class="name active">首页</view>
			</view>
			<view class="item" @click="redirectPage('/guanlishi/order/order')">
				<image class="icon" src="/static/tab/order.png"></image>
				<view class="name">订单</view>
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
</template>

<script>
	export default {
		data() {
			return {
				title: 'Hello',
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
			// const webView = this.$scope.
			// uni.hideHomeButton()
		},
		methods: {
			redirectPage(url) {
				uni.reLaunch({
					url
				})
			},
			navPage(url, status = 1) {
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

<style lang="scss">
	page {
		background-color: #F6F6F6;
		/* 这里设置你想要的背景颜色 */
		padding: 0 0rpx;
	}

	.tabbar {
		position: fixed;
		bottom: 0;
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
		min-height: 100vh;
		background-color: #F6F6F6;
	}

	.header {
		width: 750rpx;
		height: 220rpx;
		background: #FFFFFF;
		padding: 30rpx;
		box-sizing: border-box;
		display: flex;

		.card {
			width: 330rpx;
			height: 160rpx;
			background: linear-gradient(90deg, #F1F5FF 0%, #DEE4FF 100%);
			border-radius: 20rpx;


			.top {
				display: flex;
				align-items: center;
				padding-top: 36rpx;
				padding-left: 30rpx;
				box-sizing: border-box;

				.t-img {
					width: 35rpx;
					height: 35rpx;
				}

				.t-title {
					width: 180rpx;
					height: 42rpx;
					padding-left: 10rpx;
					font-family: PingFang-SC, PingFang-SC;
					font-weight: bold;
					font-size: 30rpx;
					color: #2D49C0;
					line-height: 42rpx;
					text-align: left;
					font-style: normal;
				}
			}

			.detail {
				width: 96rpx;
				height: 34rpx;
				padding-left: 80rpx;
				font-family: PingFangSC, PingFang SC;
				font-weight: 400;
				font-size: 24rpx;
				color: #6575AB;
				line-height: 34rpx;
				text-align: left;
				font-style: normal;
				margin-top: 10rpx;
			}
		}

		.card-active {
			background: linear-gradient(90deg, #FFF4F2 0%, #FFE3DE 100%);
			margin-left: 30rpx;
			width: 330rpx;
			height: 160rpx;
			border-radius: 20rpx;


			.top {
				display: flex;
				align-items: center;
				padding-top: 36rpx;
				padding-left: 30rpx;

				.t-img {
					width: 35rpx;
					height: 35rpx;
				}

				.t-title {
					width: 180rpx;
					height: 42rpx;
					padding-left: 10rpx;
					font-family: PingFang-SC, PingFang-SC;
					font-weight: bold;
					font-size: 30rpx;
					color: #C33333;
					line-height: 42rpx;
					text-align: left;
					font-style: normal;
				}
			}

			.detail {
				width: 96rpx;
				height: 34rpx;
				padding-left: 80rpx;
				font-family: PingFangSC, PingFang SC;
				font-weight: 400;
				font-size: 24rpx;
				color: #F2685C;
				line-height: 34rpx;
				text-align: left;
				font-style: normal;
				margin-top: 10rpx;
			}
		}
	}

	.content {
		margin-left: 30rpx;
		margin-right: 30rpx;

		.title {

			margin-top: 30rpx;
		}

		.group-btn {
			display: flex;
			margin-top: 20rpx;

			.btn {
				width: 132rpx;
				height: 52rpx;
				background: #FFFFFF;
				border-radius: 10rpx;
				margin-right: 30rpx;
				text-align: center;
				line-height: 52rpx;
				color: #666666;
			}

			.active {
				background: linear-gradient(90deg, #D275F2 0%, #AE38D7 100%);
				color: white;
			}
		}

		.card {
			margin-top: 20rpx;
			width: 690rpx;
			height: 406rpx;
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
						width: 192rpx;
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
						width: 140rpx;
						height: 44rpx;
						font-family: PingFang-SC, PingFang-SC;
						font-weight: bold;
						font-size: 24rpx;
						color: #E62626;
						line-height: 34rpx;
						text-align: left;
						font-style: normal;
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