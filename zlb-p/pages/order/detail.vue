<template>
  <view class="detail-page">
    <view class="status" :class="order.status">{{ statusText(order.status) }}</view>
    <view class="card">
      <view class="header">
        <image :src="order.cover" class="cover" mode="aspectFill" />
        <view class="header-info">
          <view class="name">{{ order.gym }}</view>
          <view class="mode">{{ order.mode }}</view>
        </view>
      </view>
      <view class="schedule">
        <view v-for="(it,i) in order.orderItems" :key="i" class="row">
          <text class="flex">{{ it.date }}</text>
          <text class="flex">{{ it.field }}</text>
          <text class="flex">{{ it.time }}</text>
          <text class="money">{{ it.amount }}</text>
        </view>
        <view class="total">总计：{{ order.totalHours }}小时 {{ order.amount }}</view>
      </view>
      <view class="fee">
        <view class="row"><text class="label">实付金额</text><text class="value strong">{{ order.payReal }}</text></view>
        <view class="row"><text class="label">优惠金额</text><text class="value">{{ order.discount }}</text></view>
        <view class="row"><text class="label">支付方式</text><text class="value">{{ order.payMethod }}</text></view>
        <view class="row"><text class="label">下单时间</text><text class="value">{{ order.createTime }}</text></view>
      </view>
    </view>
    <u-button v-if="order.canRate" type="primary" shape="circle" class="rate-btn" @click="openRate">去评价</u-button>
    <OrderRate ref="rate" @submit="submitRate" />
  </view>
</template>

<script>
import OrderRate from '@/components/OrderRate.vue'
export default {
  components:{OrderRate},
  data(){
    return {
      order:{
        status:'done',
        cover:'https://via.placeholder.com/120',
        gym:'示例场馆',
        mode:'在线预定',
        orderItems:[{date:'2025-01-01',field:'A1',time:'08:00-09:00',amount:'￥50.00'}],
        totalHours:1,
        amount:'￥50.00',
        payReal:'￥50.00',
        discount:'￥0.00',
        payMethod:'微信支付',
        createTime:'2025-01-01 10:00',
        canRate:true
      }
    }
  },
  methods:{
    statusText(s){
      const map={unused:'待使用',done:'已完成',refund:'已退款'}
      return map[s]||''
    },
    openRate(){
      this.$refs.rate.open(this.order.orderNo)
    },
    submitRate(data){
      // TODO submit rating
    }
  }
}
</script>

<style scoped>
.detail-page{
  background:#F5F5F5;
  min-height:100vh;
  padding:24rpx;
}
.status{
  font-size:28rpx;
  font-weight:600;
  margin-bottom:20rpx;
}
.status.unused{color:#FF5722;}
.status.done{color:#909399;}
.status.refund{color:#909399;}
.card{
  background:#FFFFFF;
  border-radius:8px;
  box-shadow:0 2rpx 8rpx rgba(0,0,0,0.05);
  padding:24rpx;
}
.header{
  display:flex;
}
.cover{
  width:120rpx;
  height:120rpx;
  border-radius:8px;
  margin-right:20rpx;
}
.header-info{
  flex:1;
}
.name{
  font-size:28rpx;
  font-weight:600;
  color:#202020;
}
.mode{
  font-size:22rpx;
  color:#606266;
  margin-top:4rpx;
}
.schedule{
  background:#F7F8FA;
  border-radius:8px;
  padding:24rpx;
  margin-top:20rpx;
}
.row{
  display:flex;
  font-size:24rpx;
  line-height:36rpx;
}
.row + .row{border-top:1rpx solid #EBEEF5;}
.flex{flex:1;}
.money{width:140rpx;text-align:right;font-weight:600;}
.total{margin-top:10rpx;text-align:right;font-size:24rpx;font-weight:600;}
.fee{
  margin-top:20rpx;
  font-size:24rpx;
}
.fee .row{display:flex;justify-content:space-between;line-height:36rpx;}
.fee .strong{font-weight:600;}
.rate-btn{width:80%;margin:40rpx auto;}
</style>
