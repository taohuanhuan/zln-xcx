<template>
	<view class="container" style="width:690rpx">


		<view class="search">

			<u-search placeholder="请输入关键词搜索查询" height="72rpx" shape="round" v-model="keyword" bgColor="#ffffff"
				:show-action="false"></u-search>

		</view>

		<view class="counselor-item" @click="goxq(item.consultant_id)" v-for="item in consulationList"
			:key="item.consultant_id">
			<image class="counselor-image" :src="item.consultant_avator|avatarFilter"></image>
			<view class="counselor-info">
				<view class="counselor-name-row" style="justify-content: space-between;">
					<text class="counselor-name">{{item.consultant_name}}</text>
					<text>{{item.consultant_type|consultantTypeFilter}}</text>
				</view>

				<view class="counselor-name-row">
					<view style="margin-right: 20rpx;">
						<u-tag :borderColor="'#F19436'" :bg-color="'#FFEEDE'" :color="'#F19436'" class="m-l-10"
							text="新课首发" size="mini"></u-tag>
					</view>

					<u-tag size="mini" :borderColor="'#F19436'" :bg-color="'#FFEEDE'" :color="'#F19436'" class="m-l-10"
						text="收录5年">
					</u-tag>
				</view>
				<text class="counselor-detail" style="color: #999999;">简介：<text
						style="color: #555555;">{{item.consultant_summarized}}
					</text></text>
				<text class="counselor-detail" style="color: #999999;">擅长方向：：<text
						style="color: #555555;">亲密关系/职业发展…</text></text>
				<text class="counselor-detail" style="color: #999999;">最早可预约时间：<text
						style="color: #555555;">{{item.earliest_time}}</text></text>

				<view class="counselor-stats-row">
					<text class="counselor-stats" style="color: #999999;"><text
							style="color: #EF851A;">{{item.consult_count}}</text>人咨询 ·
						<text style="color: #EF851A;">{{item.favorable_rate}}%</text>好评</text>

					<view class="book-div" style="text-align: right;">
						<button class="book-button">预约</button>
					</view>
				</view>
			</view>
		</view>
		<view style="text-align: center;font-size: 25rpx;color: #999999;">没有更多了</view>
		<view class="" style="height: 500rpx; width: 300rpx;">

		</view>
	</view>
</template>
<script>
	import {
		getDataDictionaryList,
		getConsultantList,
		getBannerList
	} from '@/config/api.js'
	import {
		DOMAIN
	} from '@/config/config.js';
	var vueApp = null;
	export default {
		data() {
			return {
				value: "",
				tabs: [],
				sortKey: '',
				sortOrder: '',
				list1: [],
				consulationList: [],
				keyword: ''
			};
		},
		computed: {
			sortedItems() {
				if (this.sortKey) {
					return this.items.slice().sort((a, b) => {
						if (this.sortOrder === 'asc') {
							return a[this.sortKey] > b[this.sortKey] ? 1 : -1;
						} else {
							return a[this.sortKey] < b[this.sortKey] ? 1 : -1;
						}
					});
				}
				return this.items;
			}
		},
		async onLoad(options) {
			vueApp = this;
			this.keyword = options.keyword
			this.consulationList = await getConsultantList({
				keyword: options.keyword,
				limit: 1000
			})

		},
		methods: {
			toggleSort(key) {
				if (this.sortKey === key) {
					this.sortOrder = this.sortOrder === 'asc' ? 'desc' : 'asc';
				} else {
					this.sortKey = key;
					this.sortOrder = 'asc';
				}
			},
			isAscending(key) {
				return this.sortKey === key && this.sortOrder === 'asc';
			},
			isDescending(key) {
				return this.sortKey === key && this.sortOrder === 'desc';
			},
			isSelected(key) {
				return this.sortKey === key;
			},
			goxq(id) {
				uni.navigateTo({
					url: '/pages/supervision/consultant_details?id=' + id
				});
			},
			async changeTab(e) {
				this.consulationList = await getConsultantList({
					consultant_type: e.id
				})
			}
		},
		filters: {
			consultantTypeFilter(type) {
				let consultantType = '';
				vueApp.tabs.forEach((item) => {
					if (item.id == type) {
						consultantType = item.name
					}
				})

				return consultantType;
			}
		}
	}
</script>

<style scoped>
	page {}

	.container {
		height: 100vh;
		width: 690rpx;
	}

	.search {
		padding: 30rpx 0 20rpx 0;
	}

	.van-search__content {
		background-color: #ffffff !important;
	}

	.van-search {
		padding: 0 0 !important;
		background-color: rgba(0, 0, 0, 0) !important;
	}

	.my-swipe .van-swipe-item {
		color: #fff;
		font-size: 20px;
		line-height: 300rpx;
		text-align: center;
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
		margin-bottom: 30rpx;
	}

	.m-l-10 {
		margin: 0 5rpx;
	}


	.sort-options {
		display: flex;
		justify-content: space-around;
		padding: 24rpx;
		background-color: #ffffff;
		font-size: 26rpx;
		margin: 0 -30rpx;

	}

	.sort-item {
		display: flex;
		align-items: center;
		cursor: pointer;
	}

	.sort-icons {
		display: flex;
		flex-direction: column;
		align-items: center;
		margin-left: 5px;
		/* 控制文字与图标的间距 */
	}

	.sort-icons .triangle-up,
	.sort-icons .triangle-down {
		width: 0;
		height: 0;
		border-left: 10rpx solid transparent;
		border-right: 10rpx solid transparent;
		margin: 2px 0;
	}

	.triangle-up {
		border-bottom: 10rpx solid #999999;
	}

	.triangle-down {
		border-top: 10rpx solid #999999;
	}

	.triangle-up.active {
		border-bottom-color: #242424;
	}

	.triangle-down.active {
		border-top-color: #242424;
	}

	.sort-item.active span {
		font-weight: bold;
		/* 选中状态下文字加粗 */
	}

	.counselor-item {
		display: flex;
		padding: 30rpx 20rpx;
		margin: 30rpx 0;
		background-color: #fff;
		border-radius: 24rpx;
	}

	.counselor-image {
		width: 160rpx;
		height: 160rpx;
		min-width: 160rpx;
		border-radius: 16rpx;
		margin-right: 20rpx;
	}

	.counselor-info {
		flex-grow: 1;
		display: flex;
		flex-direction: column;
		justify-content: space-between;
	}

	.counselor-name-row {
		display: flex;
		align-items: center;
		margin-bottom: 20rpx;
	}

	.counselor-name {
		font-weight: bold;
		font-size: 32rpx;
		color: #242424;
		margin-right: 10rpx;
	}

	.counselor-detail {
		font-size: 24rpx;
		margin-bottom: 10rpx;
	}

	.counselor-stats-row {
		display: flex;
		justify-content: space-between;
		align-items: center;
	}

	.counselor-stats {
		font-size: 24rpx;
		color: #EF851A;
	}

	.book-button {
		width: 120rpx;
		height: 60rpx;
		border-radius: 30rpx;
		line-height: 60rpx;
		color: #AE38D7;
		border: none;
		border: solid 1rpx #AE38D7;
		font-size: 28rpx;
	}
</style>