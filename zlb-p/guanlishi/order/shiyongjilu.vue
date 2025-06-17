<template>
	<view>
		<view class="feiyong" @click="navPage('/guanlishi/user/jiuzhen_xiangqing')">
			<view class="item-header">
				<view class="title">就诊记录标题</view>
			</view>
			<CCell title="就诊时长" desc="40分钟"></CCell>
			<CCell title="就诊时间" desc="2024.07.10 08:28——18"></CCell>
		</view>
	</view>
</template>

<script>
	import CCell from '@/components/CCell.vue'
	export default {
		data() {
			return {
				
			};
		},
		components: {
			CCell
		},
	}
</script>

<style lang="scss" scoped>
	.item-header{
		margin-bottom: 20rpx;
	}
.feiyong {
		padding: 30rpx;
		box-sizing: border-box;
		background-color: white;
		margin-top: 20rpx;
		border-radius: 16rpx;
		.item-header{
			display: flex;
			align-items: end;
			justify-content: space-between;
			.update{
				font-weight: 400;
				font-size: 24rpx;
				color: #242424;
			}
		}
	}
</style>

