<template>
	<view class="main" style="width: 690rpx;">
		<view class="card">
			<view class="title">圆融国际心理咨询中心介绍</view>
			<view class="text">
				安肯心理是一家全国连锁的医学心理健康服务机构。我们安肯人以“为亿万中国家庭提供私家心理医生服务”为使命。为4-60岁人群的心理困扰(例如亲子、婚恋、职场、人际等)和心理疾病(例如多动、抑郁焦虑、失眠等)，提供药物心理物理一站式解决方案。
			</view>
		</view>
		<view class="card">
			<view class="title">入驻邀请</view>
			<view class="text">
				安肯心理是一家全国连锁的医学心理健康服务机构。我们安肯人以“为亿万中国家庭提供私家心理医生服务”为使命。为4-60岁人群的心理困扰(例如亲子、婚恋、职场、人际等)和心理疾病(例如多动、抑郁焦虑、失眠等)，提供药物心理物理一站式解决方案。
			</view>
		</view>

		<view class="card">
			<view class="title">入驻要求</view>
			<view class="text">
				安肯心理是一家全国连锁的医学心理健康服务机构。我们安肯人以“为亿万中国家庭提供私家心理医生服务”为使命。为4-60岁人群的心理困扰(例如亲子、婚恋、职场、人际等)和心理疾病(例如多动、抑郁焦虑、失眠等)，提供药物心理物理一站式解决方案。
			</view>
		</view>
		<view class="card">
			<view class="title">资料提交要求</view>
			<view class="text">
				安肯心理是一家全国连锁的医学心理健康服务机构。我们安肯人以“为亿万中国家庭提供私家心理医生服务”为使命。为4-60岁人群的心理困扰(例如亲子、婚恋、职场、人际等)和心理疾病(例如多动、抑郁焦虑、失眠等)，提供药物心理物理一站式解决方案。
			</view>
		</view>

		<view class="" style="height: 150rpx;width: 100%;">

		</view>

		<view class="btn" @click="navPage('/pages/ruzhu/shenqingruzhu')">申请入驻</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				fileList: [{
						url: 'https://img01.yzcdn.cn/vant/leaf.jpg'
					},
					{
						url: 'https://cloud-image',
						isImage: true
					},
				],
			};
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
	.main {
		// padding-left: 30rpx;
		// padding-right: 30rpx;
		padding-top: 20rpx;
		background-color: #F6F6F6;
		min-height: 100vh;

		.card {
			background-color: white;
			padding: 30rpx;
			box-sizing: border-box;
			border-radius: 16rpx;
			margin-bottom: 20rpx;

			.title {
				font-weight: bold;
				font-size: 32rpx;
				color: #242424;
			}

			.text {
				font-weight: 400;
				font-size: 28rpx;
				color: #666666;
				margin-top: 40rpx;
			}

			.item {
				height: 80rpx;
				display: flex;
				align-items: center;

				// justify-content: space-between;
				.left {
					width: 130rpx;
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

			.upload {
				margin-top: 20rpx;

				.title {
					font-weight: 400;
					font-size: 28rpx;
					color: #666666;
					margin-bottom: 20rpx;
				}

				.text {
					background-color: #F6F6F6;
					border-radius: 16rpx;
					padding: 20rpx;
					box-sizing: border-box;
					height: 160rpx;
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