<template>
	<view class="tpq">

		<!-- 标题部分 -->
		<view class="tpqt">
			{{ newsDetail.news_title }}
		</view>
		<view class="" style="font-size: 28rpx; color: #666666;">
			{{ newsDetail.news_intro }}
		</view>
		<view class="" style="font-size: 28rpx; color: #666666;" v-html="newsDetail.news_content">
		</view>

	</view>
</template>

<script>
	import {
		getNewsByType
	} from '@/config/api'; // 引入获取新闻的API

	export default {
		data() {
			return {
				newsDetail: {} // 用于存储新闻详情数据
			};
		},
		methods: {
			// 获取新闻详情数据
			async fetchNewsDetail(id) {
				const params = {
					type: id
				}; // 设置请求参数，假设这里是新闻类型
				const response = await getNewsByType(params); // 调用接口
				this.newsDetail = response; // 将新闻详情存储到 newsDetail
				console.log('新闻详情:', this.newsDetail); // 打印新闻详情数据
			}
		},
		onLoad(options) {
			// 获取传递过来的id参数
			const {
				id
			} = options;
			if (id) {
				this.fetchNewsDetail(id); // 根据id获取新闻详情
			}
		}
	};
</script>

<style scoped>
	.tpq {
		padding: 30rpx;
		border-radius: 16rpx;
		background-color: #ffffff;
		width: 750rpx;
		max-width: 100%;
		/* 确保在小屏幕上不会超出 */
		box-sizing: border-box;
		/* 包括 padding 在内计算宽度 */
		margin: 30rpx 0;
	}

	.tpqt {
		font-weight: bold;
		font-size: 32rpx;
		color: #242424;
		margin: 0 0 30rpx 0;
	}
</style>

<style>
	page {
		padding: 0 0;
	}
</style>