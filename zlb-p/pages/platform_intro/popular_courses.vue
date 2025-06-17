<template>
	<view class="container" style="width:690rpx">

		<view class="search">
			<u-search placeholder="请输入关键词搜索查询" height="72rpx" shape="round" v-model="value" bgColor="#ffffff"
				 :show-action="false"></u-search>
		</view>


		<view style="margin: 0 0 20rpx 0;">
			<!-- <u-swiper :list="list1" @change="change" @click="click" height="300rpx"></u-swiper> -->
		</view>
		<view class="" style="background-color: #ffffff;margin: 0 -30rpx;">
			<u-tabs :scrollable="true" :list="tabs" @click="click" lineWidth="30" lineHeight="5" lineColor="#C871E7"
				:activeStyle="{
			        fontWeight: 'bold',
			    }"></u-tabs>
		</view>
		<view class="course-list-item" @click="navigateToCourseDetailso">
			<image src="../../static/img/it4.png" class="course-image"></image>
			<view class="course-info">
				<view class="course-title m-l-10">身体心理学38讲：读懂身体的秘密，迈开改变的步伐</view>
				<view class="course-labels m-l-10">
					<view class="" style="display: flex;">

						<view style="margin-right: 20rpx;">
							<u-tag :borderColor="'#F19436'" :bg-color="'#FFEEDE'" :color="'#F19436'" size="mini"
								class="m-l-10" text="新课首发"></u-tag>
						</view>

						<u-tag :borderColor="'#F19436'" :bg-color="'#FFEEDE'" :color="'#F19436'" size="mini"
							class="m-l-10" text="收录5年"></u-tag>

					</view>

					<view class="course-mode">线上</view>
				</view>
				<view class="course-pricing m-l-10">
					<view class="">


						<view class="price-discount">¥39.9</view>
						<view class="price-original">¥69.9</view>
					</view>
					<view class="book-div">
						<button class="book-button">拼团价：¥19.9</button>
					</view>
				</view>
			</view>
		</view>

		<view class="course-list-item" @click="navigateToCourseDetailso2">
			<image src="../../static/img/it4.png" class="course-image"></image>
			<view class="course-info">
				<view class="course-title m-l-10">未来世界生存法则：李松蔚认知思维16讲</view>
				<view class="course-labels m-l-10">
					<view class="" style="display: flex;">

						<view style="margin-right: 20rpx;">
							<u-tag :borderColor="'#F19436'" :bg-color="'#FFEEDE'" :color="'#F19436'" size="mini"
								class="m-l-10" text="新课首发"></u-tag>
						</view>

						<u-tag :borderColor="'#F19436'" :bg-color="'#FFEEDE'" :color="'#F19436'" size="mini"
							class="m-l-10" text="收录5年"></u-tag>

					</view>

					<view class="course-mode">线下</view>
				</view>
				<view class="course-pricing m-l-10">
					<view class="">


						<view class="price-discount">¥39.9</view>
						<view class="price-original">¥69.9</view>
					</view>
					<view class="book-div">
						<button class="book-button">拼团价：¥19.9</button>
					</view>
				</view>
			</view>
		</view>








		<view class="" style="height: 500rpx; width: 300rpx;">

		</view>
	</view>
</template>
<script>
	export default {
		data() {
			return {
				value: "",

				tabs: [{
					name: '萨提亚咨询师认证课程',
				}, {
					name: '葛老师经典课程',
				}, {
					name: '圆融品牌课程',
				}, {
					name: '婚姻家庭',
				}, {
					name: '恋爱',
				}],
			
			};
		},
		methods: {
			navigateToCourseDetailso() {
				uni.navigateTo({
					url: '/pages/kecheng/course_details_online'
				});
			},


			navigateToCourseDetailso2() {
				uni.navigateTo({
					url: '/pages/kecheng/course_details_offline'
				});
			},
		}
	}
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