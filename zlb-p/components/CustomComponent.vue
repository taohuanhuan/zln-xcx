<template>
	<view class="con" @tap="handleNavigate">
		<!-- 内容区域 -->
		<view class="menu-bar" v-if="title">
			<view class="title">{{ title }}</view>
			<view v-if="showDescription" class="description">
				<view class="">
					{{ description }}
					
				</view>
				<u-icon v-if="iconName" :name="iconName" class="icon"></u-icon>
			</view>
		</view>
		<!-- 底部插槽区域 -->
		<view class="bottom">
			<slot name="bottom-content"></slot>
		</view>
	</view>
</template>

<script>
	export default {
		name: 'CustomComponent',
		props: {
			title: {
				type: String,
				required: true
			},
			description: String,
			iconName: String, // 可选的图标名称
			showDescription: {
				type: Boolean,
				default: false
			},
			navigateToUrl: String // 新增属性
		},
		methods: {
			handleNavigate() {
				console.log(this.navigateToUrl)
				if (this.navigateToUrl) {
					uni.navigateTo({
						url: this.navigateToUrl
					});
				}
			}
		},
		mounted() {
			console.log(this.navigateToUrl)

		}
	}
</script>

<style scoped>
	.con {
		background: #FFFFFF;
		border-radius: 20rpx;
	}

	.menu-bar {
		display: flex;
		justify-content: space-between;
		padding: 26rpx 0;
		margin: 0 30rpx;

	}

	.title {
		font-size: 34rpx;
		color: #242424;
		font-weight: bold;
	}

	.description {
		font-size: 28rpx;
		color: #7C7C7C;
		display: flex;
		align-items: center;
	}

	.icon {
		font-size: 28rpx;
		/* 调整以适应图标尺寸 */
		color: #7C7C7C;

	}

	.bottom {
		/* 可以添加底部内容区域的样式 */
	}
</style>