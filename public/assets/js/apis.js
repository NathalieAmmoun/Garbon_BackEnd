$(document).ready(getUnapprovedCollectors);

function getUnapprovedCollectors(){
    unApprovedCollectorsAPI().then(collectors=>{
        console.log(collectors);
         $.each(collectors, function(index, collector){
             let recyclables = "";
             $.each(collector.recyclables, function(index,recyclable){

                recyclables+=`<p class="card-text">${recyclable[0].name}</p>`;
            })
             $(".collectors_div").append(`<div id='collector_${collector.collectors.id}' class='card col-md-3'><div class='card-body'><h4 class="card-title mb-3">Collector Name: ${collector.collectors.name}</h4><p class="card-text">Description: ${collector.collectors.description}</p><p>Recycles:<p> ${recyclables}
             <button style='width:50%' type='button' onclick='approve(${collector.collectors.id});' class='btn btn-success'>Approve</button><button type='button' style='width:50%' onclick='deleteCollector(${collector.collectors.id});' class='btn btn-danger'>Decline</button></div></div><div class='col-md-1'></div>`)});
}).catch(error => {
    console.log(error.message);
});

}


async function unApprovedCollectorsAPI(){
    var access_token = $("#access_token").val();
    var authorization = "bearer "+access_token;
    var accept = "application/json";
    const response = await fetch("https://garbon.tk/api/auth/unapproved-collectors", {
        method: 'GET',
        headers: {
            'Authorization': authorization,
            'Accept': accept
        }
    });
    
    if(!response.ok){
        const message = "ERROR OCCURED";
        throw new Error(message);
    }
    
    const collectors = await response.json();
    return collectors;
}




function approve(collector_id){
    approveAPI(collector_id).then(approve_response=>{
         $("#collector_"+collector_id).hide();
}).catch(error => {
    console.log(error.message);
});
}

async function approveAPI(collector_id){
    console.log(collector_id);
    var access_token = $("#access_token").val();
    var authorization = "bearer "+access_token;
    var accept = "application/json";
    const response = await fetch("https://garbon.tk/api/auth/approve-collector", {
        method: 'POST',
        headers: {
            'Authorization': authorization,
            'Accept' : accept,
            'collectorID': collector_id
        },

    });
    
    if(!response.ok){
        const message = "ERROR OCCURED";
        throw new Error(message);
    }
    
    const approve_response = await response.json();
    return approve_response;
}


function deleteCollector(collector_id){
    deleteCollectorAPI(collector_id).then(delete_response=>{
         $("#collector_"+collector_id).hide();
}).catch(error => {
    console.log(error.message);
});
}

async function deleteCollectorAPI(collector_id){
    var access_token = $("#access_token").val();
    var authorization = "bearer "+access_token;
    var accept = "application/json";
    const response = await fetch("https://garbon.tk/api/auth/disapprove-collector", {
        method: 'POST',
        headers: {
            'Authorization': authorization,
            'Accept' : accept,
            'collectorID': collector_id
        },

    });
    
    if(!response.ok){
        const message = "ERROR OCCURED";
        throw new Error(message);
    }
    
    const delete_response = await response.json();
    return delete_response;
}

