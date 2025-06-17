<template>
	<view>
		<view class="main">
			<!-- <view class="status">
				<image class="icon" src="/static/img/order_dcl.png"></image>
				<view class="title">待处理</view>
			</view> -->

			<view class="user">
				<view class="top" @click="navPage('/guanlishi/user/user_info')">
					<view class="title">用户信息</view>
					<view class="dangan">
						<view class="text">查看档案</view>
						<image class="icon" src="/static/img/jiantou-r.png"></image>
					</view>
				</view>
				<view class="detail">
					<image class="avatar" src="/static/img/avatar.png"></image>
					<view class="name">孟善致</view>
				</view>
			</view>

			<view class="zixunxinxi">
				<view class="title">咨询信息</view>
				<view class="user">
					<image class="avatar" src="../../static/img/avatar.png"></image>
					<view class="info">
						<view class="name">孟善致</view>
						<view class="pro">我是服务项目名称</view>
						<view class="price">¥2383.00</view>
					</view>
				</view>
				<view class="item">
					<CCell title="预约类型" desc="线上"></CCell>
					<CCell title="预约时间" desc="2024.07.10 08:00-09:00"></CCell>
					<CCell title=" " desc="2024.07.10 08:00-09:00"></CCell>
					<CCell title="咨询次数" desc="3次"></CCell>
				</view>
			</view>

			<view class="dangwei">
				<dangwei title="安肯心理咨询（宝安中心店）" desc="湖北省恩施土家族苗族自治州咸丰县仁廉路273号"></dangwei>
			</view>

			<view class="feiyong">
				<view class="title">费用信息</view>
				<view class="item">
					<view class="right-title">价格</view>
					<view class="left">
						<view class="price" >¥2383.00</view>
						<!-- <image  class="icon" src="../../static/img/jiantou-r.png"></image> -->
					</view>
				</view>
				<view class="item">
					<view class="right-title">优惠券</view>
					<view class="left">
						<view class="sub-desc" >暂无可用优惠券</view>
						<image  class="icon" src="../../static/img/jiantou-r.png"></image>
					</view>
				</view>
				<view class="item">
					<view class="right-title">优惠活动</view>
					<view class="left">
						<view class="sub-desc" >无</view>
					</view>
				</view>
				<view class="item">
					<view class="right-title">积分抵扣</view>
					<view class="left">
						<view class="sub-desc" >无</view>
					</view>
				</view>
				<view class="item heji">
					<text style="font-weight: 400;font-size: 28rpx;color: #242424;">合计：</text>
					<text style="font-weight: bold;font-size: 24rpx;color: #E62626;">￥</text>
					2383.00
				</view>
			</view>
			<view class="feiyong">
				<view class="title">订单信息</view>
				<CCell title="下单时间" desc="2024.05.05 09:34:22"></CCell>
				<CCell title="支付时间" desc="2024.05.05 09:36:56"></CCell>
				<CCell title="订单编号" desc="4944979705557980981"></CCell>
			</view>
			<view class="tz" @click="navPage('/guanlishi/order/shiyongjilu')">
				<view class="title">使用记录</view>
				<view class="desc"> <image class="icon" src="../../static/img/jiantou-r.png" /></view>
			</view>
			<view class="tz" @click="navPage('/pages/ruzhu/laifangxinxi')">
				<view class="title">用户调查表</view>
				<view class="desc"> 已填写 <image class="icon" src="../../static/img/jiantou-r.png" /></view>
			</view>
			<view style="height: 200rpx;"></view>
		</view>
		<view class="order">
			<view class="price">¥39.9</view>
			<view class="btn" @click="navPage('/guanlishi/user/dangan_form')">填写用户档案</view>
		</view>
	</view>

</template>

<script>
	import CCell from '@/components/CCell.vue'
	import dangwei from '@/components/dangwei.vue'
	export default {
		data() {
			return {

			}
		},
		components: {
			CCell,
			dangwei
		},
		methods: {
			navPage(url) {
				uni.navigateTo({
					url
				})
			}
		}
	}
</script>

<style lang="scss" scoped>
	.title {
		font-weight: bold;
		font-size: 32rpx;
		color: #242424;
	}

	.main {
		min-height: 100vh;
		background-color: #F6F6F6;
		padding: 30rpx;
	}

	.status {
		display: flex;
		align-items: center;

		.icon {
			width: 40rpx;
			height: 40rpx;
		}

		.title {
			font-weight: bold;
			font-size: 46rpx;
			color: #242424;
			padding-left: 24rpx;
		}
	}

	.user {
		padding: 30rpx;
		background-color: white;
		border-radius: 16rpx;
		margin-top: 30rpx;

		.top {
			display: flex;
			justify-content: space-between;
			align-items: center;

			.info {}

			.dangan {
				display: flex;
				align-items: center;

				.text {
					font-weight: 400;
					font-size: 24rpx;
					color: #242424;
				}

				.icon {
					width: 20rpx;
					height: 20rpx;
				}
			}
		}

		.detail {
			display: flex;
			align-items: center;
			margin-top: 40rpx;

			.avatar {
				width: 120rpx;
				height: 120rpx;
				border-radius: 50%;
			}

			.name {
				font-weight: bold;
				font-size: 30rpx;
				color: #242424;
				margin-left: 20rpx;
			}
		}

	}

	.zixunxinxi {
		padding: 30rpx;
		background-color: white;
		border-radius: 16rpx;
		margin-top: 20rpx;

		.user {
			display: flex;
			height: 160rpx;
			padding: 0;

			.avatar {
				width: 160rpx;
				height: 160rpx;
				border-radius: 10rpx;
			}

			.info {
				display: flex;
				flex-direction: column;
				justify-content: space-between;
				margin-left: 20rpx;

				.name {
					font-weight: bold;
					font-size: 30rpx;
					color: #242424;
				}

				.pro {
					font-weight: 400;
					font-size: 24rpx;
					color: #666666;
				}

				.price {
					font-weight: bold;
					font-size: 24rpx;
					color: #E62626;
				}
			}
		}

		.item {
			margin-top: 30rpx;
		}
	}

	.dangwei {
		margin-top: 20rpx;
	}

	.feiyong {
		padding: 30rpx;
		box-sizing: border-box;
		background-color: white;
		margin-top: 20rpx;
		border-radius: 16rpx;
		.item{
			display: flex;
			justify-content: space-between;
			margin-top: 30rpx;
			.right-title{
				font-weight: 400;
				font-size: 28rpx;
				color: #242424;
			}
			.price{
				font-weight: 400;
				font-size: 28rpx;
				color: #E62626;
			}
			.right-title{
				font-weight: 400;
				font-size: 28rpx;
				color: #999999;
			}
			.left{
				display: flex;
				align-items: center;
				
				.sub-desc{
					font-weight: 400;
					font-size: 28rpx;
					color: #999999;
				}
				.icon{
					width: 30rpx;
					height: 30rpx;
				}
			}
			
		}
		
		.heji{
			display: flex;
			align-items: center;
			justify-content: flex-end;
			
			font-weight: bold;
			font-size: 28rpx;
			color: #E62626;
			
		}
		
	}
	.tz{
		display: flex;
		justify-content: space-between;
		align-items: center;
		
		padding: 30rpx;
		box-sizing: border-box;
		background-color: white;
		margin-top: 20rpx;
		border-radius: 16rpx;
		.title{
			font-weight: bold;
			font-size: 32rpx;
			color: #242424;
		}
		.desc{
			font-weight: 400;
			font-size: 28rpx;
			color: #666666;
			display: flex;
			align-items: center;
			.icon{
				width: 30rpx;
				height: 30rpx;
			}
		}
	}

	.order {
		background-color: white;
		height: 166rpx;
		width: 750rpx;
		padding: 30rpx;
		box-sizing: border-box;
		position: fixed;
		bottom: 0;
		display: flex;
		justify-content: space-between;
		align-items: center;

		.price {
			font-weight: bold;
			font-size: 24rpx;
			color: #E62626;
		}

		.btn {
			// width: 200rpx;
			height: 84rpx;
			background: linear-gradient(90deg, #D275F2 0%, #AE38D7 100%);
			border-radius: 44rpx;
			font-weight: bold;
			font-size: 30rpx;
			color: #FFFFFF;
			line-height: 84rpx;
			text-align: center;
			padding-left: 30rpx;
			padding-right: 30rpx;
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