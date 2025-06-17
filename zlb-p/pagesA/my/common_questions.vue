<template>
	<view class="" style="border-radius: 16rpx;margin: 20rpx 0; background-color: #ffffff; width: 690rpx;">
		<u-collapse @change="change" @close="close" @open="open">
			<u-collapse-item v-for="(item, index) in questionList" :key="index" :title="item.question_title">
				<view class="u-collapse-content" @click="() => handleNavigate(item.question_id)">
					{{ item.question_title }}
				</view>
				<view v-if="item.sonList" v-for="(son, sIndex) in item.sonList" :key="sIndex" class="u-collapse-content">
					{{ son.question_title }}
				</view>
			</u-collapse-item>
		</u-collapse>
	</view>
</template>

<script>
import { getQuestionList, getQuestionDetail } from '@/config/api';

export default {
	data() {
		return {
			activeNames: [], // 控制默认展开的面板
			questionList: [] // 用于存储常见问题列表数据
		};
	},
	methods: {
		async fetchQuestionList() {
			try {
				// 调用常见问题列表的API
				const response = await getQuestionList({});
				this.questionList = response;
				
			} catch (error) {
				console.error('获取常见问题列表失败:', error);
			}
		},
		handleNavigate(questionId) {
			// 根据问题ID跳转到详情页
			uni.navigateTo({
				url: `/pages/my/common_questions_details?questionId=${questionId}`
			});
		}
	},
	created() {
		// 页面加载时获取常见问题列表
		this.fetchQuestionList();
	}
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