<template>
	<view>
		<view class="instructor-item">
			<image class="instructor-image" :src="clinic.clinic_logo|avatarFilter"></image>
			<view class="instructor-info">
				<text class="instructor-name">{{clinic.clinic_name}}</text>
				<text class="instructor-bio">{{clinic.clinic_address}}</text>
			</view>
		</view>

		<view class="instructor-item">
			<u-parse :content="clinic.clinic_intro"></u-parse>
		</view>
	</view>
</template>

<script>
	import {
		getClinicById
	} from '@/config/api.js'
	export default {
		data() {
			return {
				clinic: null
			};
		},
		onLoad(options) {
			getClinicById({
				clinicId: options.id
			}).then((data) => {
				this.clinic = data
			})
		}
	}
</script>

<style lang="scss" scoped>
	.instructor-item {
		display: flex;
		align-items: center;
		margin-bottom: 20rpx;
		/* 列表项间隔 */
		padding: 30rpx;
		background-color: #ffffff;
		border-radius: 26rpx;
	}

	.instructor-image {
		width: 100rpx;
		height: 100rpx;
		min-width: 100rpx;
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