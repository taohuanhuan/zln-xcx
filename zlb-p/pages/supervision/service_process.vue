<template>
	<view style="width: 690rpx;">
		<image style="border-radius: 26rpx;width: 100%;margin: 20rpx 0" mode="widthFix" src="../../static/img/kct.png">
		</image>
		<view class="blc">

			<view class="blct">
				服务流程信息
			</view>

			<view class="blcc">
				6步(共90分钟)
			</view>




			<view class="step-list">
				<view class="step-item" v-for="(step, index) in steps" :key="index">
					<view class="step-index">{{ index + 1 }}</view>
					<view class="step-content">
						<view class="step-title">{{ step.title }}</view>
						<view class="step-desc">{{ step.desc }}</view>
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
				steps: [{
						title: "第一步 占位符",
						desc: "快乐和烦恼都是自己给的"
					},
					{
						title: "第二步 占位符",
						desc: "心要大，脚要实"
					},
					{
						title: "第三步 占位符",
						desc: "做发动机，不要作飞轮"
					},
					{
						title: "第四步 占位符",
						desc: "当你的伙伴需要你伸出一只手时，不妨把肩膀也给他"
					},
					{
						title: "第五步 占位符",
						desc: ""
					},
					{
						title: "第六步 占位符",
						desc: ""
					},
				],
			}
		},
		methods: {

		}
	}
</script>

<style>
	.blc {
		padding: 30rpx;
		background-color: #ffffff;
	}

	.blct {
		font-weight: bold;
		font-size: 32rpx;
		color: #242424;
		margin-bottom: 30rpx;
	}

	.blcc {
		font-size: 28rpx;
		color: #242424;
		margin-bottom: 20rpx;
	}


	.step-list {
		padding-bottom: 20rpx;
	}

	.step-item {
		display: flex;
		align-items: flex-start;
		margin-bottom: 20rpx;
	}

	.step-index {
		width: 40rpx;
		height: 40rpx;
		line-height: 40rpx;
		border-radius: 20rpx;
		background-color: #F2CBFF;
		color: #9E19CC;
		font-size: 28rpx;
		text-align: center;
		margin-right: 20rpx;
	}

	.step-content {
		flex: 1;
	}

	.step-title {
		font-size: 28rpx;
		color: #333;
		margin-bottom: 20rpx;
	}

	.step-desc {
		font-size: 28rpx;
		color: #999;
		margin-bottom: 20rpx;
	}
</style>