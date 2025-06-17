<template>
	<view style="width: 690rpx;">
		<view class="" style="margin: 30rpx 0;">
			<custom-component title="产品信息" :show-description="false" description="" icon-name="arrow-right"
				class="m-b-20" :navigateToUrl="''" style="margin: 30rpx 0;">
				<template v-slot:bottom-content>
					<view class="course-list-item">
						<image src="../../static/img/it4.png" class="course-image"></image>
						<view class="course-info">

							<view class="course-titlet m-b-20" style="display: inline;">
								<text style="
						    display: inline-block;
						    background: linear-gradient(90deg, #FFEBDA 0%, #FFCAAB 100%);
						    border-radius: 4rpx;
						    font-size: 24rpx;
						    color: #402E21;
						    line-height: 36rpx;
						    vertical-align: middle;
						    margin-right: 10rpx;
							line-height: 36rpx;
							height: 36rpx;
							padding: 0 10rpx;
						  ">
									{{course.course_type|courseTypeFilter}}
								</text>
								<text style="line-height: 30rpx;
						font-size: 30rpx; color: #242424; font-weight: bold;">
									{{course.course_title}}
								</text>
							</view>

							<view class="course-labels m-b-20">
								<view class="" style="display: flex;">

									<view style="margin-right: 20rpx;"
										v-for="(item,idx) in course.course_tag_text.split(',')" :key="idx">
										<u-tag :borderColor="'#F19436'" :bg-color="'#FFEEDE'" :color="'#F19436'"
											size="mini" class="m-l-10" :text="item"></u-tag></u-tag>
									</view>

									<!-- <u-tag :borderColor="'#F19436'" :bg-color="'#FFEEDE'" :color="'#F19436'" size="mini"
										class="m-l-10" text="收录5年"></u-tag> -->

								</view>

							</view>
							<view class="course-pricing m-l-10">
								<view class="price-discount">¥{{course.course_price}}</view>
								<view class="price-original">¥{{course.course_orig_price}}</view>
							</view>
						</view>
					</view>

					<view class="line">

					</view>

					<view class="b-js" style="display: flex;justify-content: space-between;">
						<view class="b-kc">
							课程章节
						</view>
						<view class="b-js">
							{{course.course_count}}节
						</view>
					</view>
				</template>
			</custom-component>
		</view>

		<custom-component title="费用信息" :show-description="false" description="" icon-name="arrow-right" class="m-b-20"
			:navigateToUrl="''" style="margin: 30rpx 0;">
			<template v-slot:bottom-content>


				<view class="fee-info">
					<view class="fee-row">
						<view class="left">价格</view>
						<view class="right price">￥{{price}}</view>
					</view>
					<view class="fee-row">
						<view class="left">优惠券</view>
						<view class="right coupon">暂无可用优惠券 <van-icon name="arrow" /></view>
					</view>

					<view class="line">

					</view>
					<view class="fee-row">
						<view class="left"></view> <!-- 空左侧占位 -->
						<view class="right total fee-row">
							<view class="total-label">合计:</view>
							<view class="total-price">￥{{total}}</view>
						</view>
					</view>
				</view>

			</template>
		</custom-component>

		<view class="pay-bar">
			<view class="pay-info">
				<view class="pay-text">
					<text class="total-label">合计:</text>
					<text class="total-price">￥{{total}}</text>
				</view>
			</view>
			<view class="" style="text-align: right;">
				<button class="pay-button" @click="gopay">去支付</button>
			</view>
		</view>
	</view>

</template>

<script>
	export default {
		data() {
			return {
				course: null,
				price: 0,
				total: 0,
				is_team:0
			}
		},
		onLoad(options) {
			console.log(options)
			this.course = options
			if (this.course.tp == 'pd') {
				this.total = this.course.course_teambuy_price
				this.price = this.course.course_teambuy_price
				this.is_team = 1
			} else {
				this.total = this.course.course_price
				this.price = this.course.course_price
			}
		},
		methods: {
			gopay() {

				uni.$u.route({
					url: '/pages/purchase/single_purchase_payment',
					params: {
						course_id: this.course.course_id,
						user_coupon_id:'',
						buy_type:1,
						total:this.total,
						is_team:this.is_team
					}
				})

			}

		}
	}
</script>

<style>
	.tags {
		width: 68rpx;
		height: 36rpx;
		background: linear-gradient(90deg, #FFEBDA 0%, #FFCAAB 100%);
		border-radius: 4rpx;
		font-size: 24rpx;
		color: #402E21
	}

	.course-list-item {
		display: flex;
		padding: 20rpx;
		align-items: center;
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
	}

	.m-b-20 {
		margin-bottom: 20rpx;
	}

	.m-l-10 {
		margin: 0 5rpx;
	}


	.price-original {
		font-weight: 400;
		font-size: 36rpx;
		color: #999999;
		text-decoration: line-through;
	}

	.price-discount {
		font-weight: bold;
		font-size: 36rpx;
		color: #E62626;
	}

	.line {
		width: 630rpx;
		height: 2rpx;
		background: #F6F6F6;
		margin: 20rpx 0;
		padding: 0 30rpx;
	}

	.b-js {
		display: flex;
		justify-content: space-between;
		padding: 0 30rpx 20rpx 30rpx;
	}

	.b-kc {
		font-size: 28rpx;
		color: #666666;
	}

	.b-js {
		font-size: 28rpx;
		color: #242424;
	}

	.fee-info {
		display: flex;
		flex-direction: column;
		width: 100%;
	}

	.fee-row {
		display: flex;
		justify-content: space-between;
		align-items: center;
		margin-bottom: 10px;
		padding: 0 30rpx;
		/* 添加间距 */
	}

	.left,
	.right {
		font-weight: 400;
		font-size: 28rpx;
		color: #242424;
	}

	.price,
	.total-price {
		color: #E62626;
		/* 突出价格颜色 */
	}

	.coupon {
		color: #999999;
		/* 暂无优惠券的颜色 */
	}

	.total-label {
		font-size: 28rpx;
	}

	.total-price {
		font-size: 36rpx;
	}

	.pay-bar {
		display: flex;
		justify-content: space-between;
		align-items: center;
		padding: 16rpx 30rpx;
		background-color: #FFFFFF;
		position: fixed;
		left: 0;
		right: 0;
		bottom: 0;
		/* 悬浮于底部 */
	}

	.pay-info {
		display: flex;
		align-items: center;
	}

	.pay-text {
		display: flex;
		align-items: baseline;
		/* 基线对齐 */
	}

	.go-pay {
		font-weight: bold;
		font-size: 30rpx;
		color: #FFFFFF;
		/* 文本颜色白色 */
	}

	.total-label {
		font-weight: 400;
		font-size: 28rpx;
		color: #242424;
		/* 合计文字颜色 */
		margin-left: 10rpx;
		/* 与去支付略有间隔 */
	}

	.total-price {
		font-size: 36rpx;
		color: #E62626;
		/* 价格颜色 */
		margin-left: 5rpx;
		/* 价格与合计略有间隔 */
	}

	.pay-button {
		width: 200rpx;
		height: 84rpx;
		background: linear-gradient(90deg, #D275F2 0%, #AE38D7 100%);
		border-radius: 44rpx;
		border: none;
		/* 去除默认边框 */
		color: #FFFFFF;
		/* 按钮文本颜色 */
		font-size: 30rpx;
		/* 按钮文本大小 */
		line-height: 84rpx;
	}
</style>