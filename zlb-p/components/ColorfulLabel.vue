<template>
	<view :style="styleObject">
		{{ content }}
	</view>
</template>

<script>
	export default {
		name: 'ColorfulLabel',
		props: {
			'background-color': {
				type: String,
				default: '#FFFFFF'
			},
			'text-color': {
				type: String,
				default: '#000000'
			},
			content: {
				type: String,
				required: true
			}
		},
		computed: {
			styleObject() {
				return {
					backgroundColor: this['background-color'],
					color: this['text-color'],
					fontSize: '20rpx',
					padding: '2rpx 10rpx',
					borderRadius: '6rpx'
				};
			}
		}
	}
</script>

<style scoped>
	/* 如果需要额外的全局样式，可以在这里添加 */
</style>