import{C as l,o as a,c as m,w as e,d as f,a as o,b as d}from"./app-Bmo5HFoe.js";import{_ as p,u as b}from"./pagination-BhSgCxto.js";const c={class:"mt-6"},x={class:"flex justify-end mt-4"},_={class:"flex gap-2 w-1/2"},y={__name:"LogoutModal",emits:["close"],setup(g,{emit:n}){const s=n,r=l({}),u=()=>{r.post(route("logout"),{onSuccess:()=>{b().$reset()}})};return(v,t)=>(a(),m(p,{onClose:t[1]||(t[1]=i=>s("close"))},{title:e(()=>t[2]||(t[2]=[f("Logout")])),default:e(()=>[o("div",c,[t[4]||(t[4]=o("p",null,"Are you sure want to Logout?",-1)),o("form",{onSubmit:d(u,["prevent"])},[o("div",x,[o("div",_,[o("button",{autofocus:"",type:"button",onClick:t[0]||(t[0]=i=>s("close")),class:"flex-1 btn btn-neutral"},"Cancel"),t[3]||(t[3]=o("button",{type:"submit",class:"flex-1 btn btn-error"},"Yes",-1))])])],32)])]),_:1}))}};export{y as default};
