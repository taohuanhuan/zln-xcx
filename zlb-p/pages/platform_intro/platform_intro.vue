<template>
	<view class="platform-list">
		<view class="platform-card" v-for="(item, index) in items" :key="index" @click="navigateToPage(index)"
			:style="{ background: item.bg }">
			<text class="card-title">{{ item.text }}</text>
			<text class="card-arrow">›</text>
		</view>
	</view>
</template>

<script>
	export default {
		name: 'PlatformListItem',
		data() {
			return {
				/* 列表数据 */
				items: [{
						text: '记忆翻牌小游戏',
						bg: 'linear-gradient(135deg, #ffe4ec 0%, #e7d9ff 100%)'
					},
					{
						text: '敬请期待',
						bg: 'linear-gradient(135deg, #d8f3ff 0%, #ffe3d3 100%)'
					}
				],
				/* 对应跳转路径 */
				paths: [
					'/pages/platform_intro/flipcard',
					'' // 第二项示例：暂无跳转
				]
			}
		},
		methods: {
			navigateToPage(index) {
				const url = this.paths[index]
				if (url) {
					uni.navigateTo({
						url
					})
				} else {
					uni.showToast({
						title: '敬请期待',
						icon: 'none'
					})
				}
			}
		}
	}
</script>

<style scoped>
	/* 容器：居中显示 */
	.platform-list {
		padding: 20rpx;
		display: flex;
		flex-direction: column;
		align-items: center;
	}

	/* 单条卡片 */
	.platform-card {
		width: 690rpx;
		height: 174rpx;
		margin-bottom: 24rpx;
		border-radius: 20rpx;
		display: flex;
		align-items: center;
		justify-content: space-between;
		padding: 0 40rpx;
		box-shadow: 0 8rpx 20rpx rgba(0, 0, 0, 0.05);
		transition: transform 0.15s;
	}

	.platform-card:active {
		transform: scale(0.97);
	}

	/* 左侧标题 */
	.card-title {
		font-size: 32rpx;
		font-weight: 600;
		color: #333;
	}

	/* 右侧箭头 */
	.card-arrow {
		font-size: 40rpx;
		color: rgba(0, 0, 0, 0.25);
	}
</style>