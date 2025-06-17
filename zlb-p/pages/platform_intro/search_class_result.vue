<template>
	<view class="container" style="width:690rpx">
		<!-- 搜索栏 -->
		<view class="search">
			<u-search placeholder="请输入关键词搜索查询" height="72rpx" shape="round" v-model="keyword" bgColor="#ffffff"
				:show-action="false" @search="searchData"></u-search>
		</view>

		<!-- 课程列表 -->
		<view v-for="(course, index) in courses" :key="index" class="course-list-item"
			@click="navigateToCourseDetailso(course.course_id,course.course_type)">
			<image :src="course.course_pic|avatarFilter" class="course-image"></image>
			<view class="course-info">
				<view class="course-title m-l-10">{{ course.course_title }}</view>
				<view class="course-labels m-l-10">
					<view class="" style="display: flex;">
						<template v-for="(item,idx) in course.course_tag_text.split(',')">
							<view style="margin-right: 20rpx;">
								<u-tag :borderColor="'#F19436'" :bg-color="'#FFEEDE'" :color="'#F19436'" size="mini"
									class="m-l-10" :text="item"></u-tag>
							</view>
						</template>
						<!-- <u-tag :borderColor="'#F19436'" :bg-color="'#FFEEDE'" :color="'#F19436'" size="mini"
							class="m-l-10" text="收录5年"></u-tag> -->
					</view>
					<view class="course-mode">{{course.course_type|courseTypeFilter}}</view>
				</view>
				<view class="course-pricing m-l-10">
					<view class="">
						<view class="price-discount">¥{{ course.course_price }}</view>
						<view class="price-original">¥{{ course.course_orig_price }}</view>
					</view>
					<view class="book-div">
						<button class="book-button">拼团价：¥{{ course.course_teambuy_price }}</button>
					</view>
				</view>
			</view>
		</view>

		<view class="" style="height: 500rpx; width: 300rpx;"></view>
	</view>
</template>

<script>
	import {
		getHotCourseList,
		getDataDictionaryList,
		getBannerList
	} from '@/config/api'; // 从统一文件中引入API
	import {
		DOMAIN
	} from '@/config/config.js';
	export default {
		data() {
			return {
				keyword: "", // 绑定搜索框输入的关键词
				tabs: [],
				list1: [],
				page: 1, // 当前页数
				limit: 1000, // 每页显示条数
				courses: [] // 用于存储热门课程数据
			};
		},
		methods: {
			// 获取热门课程并打印参数和返回值
			async fetchHotCourses(id) {
				const params = {
					// keyword: this.value, // 搜索关键字
					page: this.page.toString(), // 页数转为字符串
					limit: this.limit.toString(), // 每页条数转为字符串
					keyword: this.keyword
				};

				const response = await getHotCourseList(params); // 发送请求
				this.courses = response; // 将响应数据赋值给 courses
			},
			navigateToCourseDetailso(courseId, type) {
				if (type == 1) {
					uni.navigateTo({
						url: `/pages/kecheng/course_details_online?id=${courseId}`
					});
				}
				if (type == 2) {
					uni.navigateTo({
						url: `/pages/kecheng/course_details_offline?id=${courseId}`
					});
				}
			},
			navigateToCourseDetailso2() {
				uni.navigateTo({
					url: '/pages/kecheng/course_details_offline'
				});
			},
			changeTabs(e) {
				this.fetchHotCourses(e.id)
			}
		},
		async onLoad(options) {
			this.keyword = options.keyword
			this.fetchHotCourses();
		}
	};
</script>


<style scoped>
	page {
		background-color: #fff;
	}

	.container {
		height: 100vh;
	}

	.search {
		padding: 30rpx 0 20rpx 0;
	}

	.van-search__content {
		background-color: #EFEFEF !important;
	}

	.van-search {
		padding: 0 0 !important;
		background-color: rgba(0, 0, 0, 0) !important;
	}

	.my-swipe .van-swipe-item {
		color: #fff;
		font-size: 20px;
		line-height: 300rpx;
		view-align: center;
		background-color: #39a9ed;
		border-radius: 24rpx;
	}

	/* 为图片设置的样式 */
	.my-swipe img {
		border-radius: 24rpx;

		display: block;
		/* 确保没有额外的空白 */
		width: 100%;
		/* 使图片宽度填满容器 */
		height: auto;
		/* 保持图片的宽高比 */
	}

	.m-b-20 {
		margin-bottom: 20rpx;
	}

	.m-l-10 {
		margin: 0 5rpx;
	}

	.course-list-item {
		display: flex;
		padding: 20rpx;
		align-items: center;
		background-color: #fff;
		margin: 30rpx 0;
	}

	.course-image {
		width: 160rpx;
		height: 160rpx;
		border-radius: 10rpx;
		margin-right: 20rpx;
	}

	.course-info {
		flex: 1;
		display: flex;
		flex-direction: column;
	}

	.course-title {
		font-weight: bold;
		font-size: 30rpx;
		color: #242424;
		margin-bottom: 10rpx;
	}

	.course-labels {
		display: flex;
		align-items: center;
		justify-content: space-between;
		margin-bottom: 10rpx;
	}

	.course-mode {
		font-weight: 400;
		font-size: 28rpx;
		color: #666666;
		margin-left: 10rpx;
	}

	.course-pricing {
		display: flex;
		align-items: center;
		justify-content: space-between;
	}

	.price-original {
		font-weight: 400;
		font-size: 24rpx;
		color: #999999;
		text-decoration: line-through;
	}

	.price-discount {
		font-weight: bold;
		font-size: 24rpx;
		color: #E62626;
	}

	.book-div {
		view-align: right;
	}

	.book-button {
		width: 228rpx;
		height: 52rpx;
		background-color: #F2685C;
		border-radius: 32rpx;
		line-height: 52rpx;
		color: white;
		border: none;
		font-size: 26rpx;
	}
</style>