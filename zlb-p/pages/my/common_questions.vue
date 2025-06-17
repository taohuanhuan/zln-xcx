<template>


	<view class="" style="border-radius: 16rpx;margin: 20rpx 0; background-color: #ffffff; width: 690rpx;">
		<u-collapse @change="change" @close="close" @open="open">
			<u-collapse-item title="这是常见问题分类标题" name="Docs guide">
				<view class="u-collapse-content" @click="handleNavigate">这是常见问题1的标题占位符</view>
				<view class="u-collapse-content">这是常见问题1的标题占位符</view>
				<view class="u-collapse-content">这是常见问题1的标题占位符</view>
			</u-collapse-item>

		</u-collapse>

	</view>
</template>

<script>
	export default {
		components: {

		},
		data() {
			return {
				activeNames: [] // 控制默认展开的面板
			};
		},
		methods: {
			handleNavigate() {

				uni.navigateTo({
					url: "/pages/my/common_questions_details"
				});
			}

		},
	};
</script>

<style scoped>
	.u-collapse-content {
		padding: 20rpx 0;
	}

	.u-collapse-content:not(:last-child) {
		border-bottom: 1px solid #f1f1f1;
		/* 添加浅灰色的下划线 */

	}

	.question-title {
		margin: 10px 0;
		/* 问题标题与内容之间的间距 */
	}

	/deep/.van-cell__title {
		font-weight: bold;
	}
</style>