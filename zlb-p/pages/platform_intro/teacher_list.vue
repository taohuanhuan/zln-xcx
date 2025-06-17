<template>
	<view style="width: 690rpx;">
		<view class="instructor-item">
			<image class="instructor-image" src="../../static/img/it6.png"></image>
			<view class="instructor-info">
				<text class="instructor-name">干岩荔</text>
				<text class="instructor-bio">莫斯科国立师范大学心理学硕士高级婚姻情感咨询师高级早期教育指导师高级精神分析师动力催眠咨询师中国心理…</text>
			</view>
		</view>
		<view class="instructor-item">
			<image class="instructor-image" src="../../static/img/it6.png"></image>
			<view class="instructor-info">
				<text class="instructor-name">干岩荔</text>
				<text class="instructor-bio">莫斯科国立师范大学心理学硕士高级婚姻情感咨询师高级早期教育指导师高级精神分析师动力催眠咨询师中国心理…</text>
			</view>
		</view>
		<view class="instructor-item">
			<image class="instructor-image" src="../../static/img/it6.png"></image>
			<view class="instructor-info">
				<text class="instructor-name">干岩荔</text>
				<text class="instructor-bio">莫斯科国立师范大学心理学硕士高级婚姻情感咨询师高级早期教育指导师高级精神分析师动力催眠咨询师中国心理…</text>
			</view>
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {

			}
		},
		methods: {

		}
	}
</script>

<style>
	page {
		width: 690rpx;
	}

	.instructor-item {
		display: flex;
		align-items: center;
		margin-top: 20rpx;
		/* 列表项间隔 */
		padding: 30rpx;
		background-color: #ffffff;
		border-radius: 16rpx;
	}

	.instructor-image {
		width: 160rpx;
		height: 160rpx;
		min-width: 160rpx;
		border-radius: 16rpx;
		margin-right: 20rpx;
		/* 图片与信息间隔 */
	}

	.instructor-info {
		display: flex;
		flex-direction: column;
	}

	.instructor-name {
		font-weight: bold;
		font-size: 32rpx;
		color: #242424;
		margin-bottom: 20rpx;
		/* 名字与简介间隔 */
	}

	.instructor-bio {
		font-size: 24rpx;
		color: #999999;
		display: -webkit-box;
		-webkit-box-orient: vertical;
		-webkit-line-clamp: 3;
		/* 限制为三行 */
		overflow: hidden;
		/* 超出部分隐藏 */
		text-overflow: ellipsis;
		/* 显示省略符号 */
	}
</style>