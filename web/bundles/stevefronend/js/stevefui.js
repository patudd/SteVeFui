function loginSteve(transferObject){
	// überlegung wie nur anmeldung wenn nicht angemeldet!?
    	/*$.ajax({
    	    url:"http://"+ transferObject.url +"/steve/manager/operations/v" + transferObject.ocppversion + "/" + transferObject.action,
	    type:'HEAD',
	    error: function()
	    {
	        // wenn nicht dann anmeldung!
	    	 $.post("http://"+ transferObject.url +"/steve/manager/signin",
  	  			  {
  	  				username: transferObject.username,
  	  				password: transferObject.password
  	  			  },
  	  			  function(data,status){
   	  	  			$.post("http://{{ global.url }}/steve/manager/signin",
   	 	  	  			  {
   	 	  	  				username: "{{ global.username_steve }}",
   	 	  	  				password: "{{ global.passwort_steve }}"
   	 	  	  			  },
   	 	  	  			  function(data,status){
   	 	  	  				
   	 	  	  			  });
  	  			  }); 
		    }
		});*/
	var promise = $.post("http://"+ transferObject.url +"/steve/manager/signin",
  			  {
  				username: transferObject.username,
  				password: transferObject.password
  			  },
  			  function(data,status){
  			  });
	
	return promise;
	
}
/*
Wenn nicht angemldet dann anmelden, sonst keine POST möglich
*/
function sendtoChargebox(transferObject, title, message){
	 var request;
	// wenn im SteVe nicht angemeldet!
	loginSteve(transferObject).done(function() {
		
		// nur bei Fehlern
		// connector.connectorid ? connector.connectorid : "",
		if (title)
		{
		BootstrapDialog.show({
	          type: BootstrapDialog.TYPE_WARNING, 
	          title: title,
	          message: message,
	          buttons: [{
	        	  icon: 'glyphicon glyphicon-send',
	              label: 'Ja',
	              cssClass: 'btn-primary',
	              autospin: true,
	              action: function(dialogRef){
	            	  var request = $.post("http://"+ transferObject.url +"/steve/manager/operations/v" + transferObject.ocppversion + "/" + transferObject.action,
			  	  			  {
				  	  			  chargePointSelectList: transferObject.chargeboxid+";" + transferObject.endpointaddress, 
				  	  			  connectorId: transferObject.connectorid,
				  	  			  resetType: transferObject.resettype,
				  	  			  idTag: transferObject.idtag,
				  	  			  value: transferObject.value,
				  	  			  confKey:  transferObject.confKey,
				  	  			  transactionId: transferObject.transactionid,
			  	  			  },
			  	  			  function(data,status){
			  	  				  
			  	  				BootstrapDialog.show({
			  		  				 type: BootstrapDialog.TYPE_SUCCESS, 
			  		  				title: 'Erfolgreich',
			  		  		            message: 'Befehl wurde erfolgreich übertragen!',
			  		  		            buttons: [{
			  	  	                    label: 'OK',
			  				              action: function(dialogItself){
			  				                  dialogItself.close();
			  				                  dialogRef.close();
			  				              }
			  	  	                  }]
			  		  		        });	  	  			    
			  	  			  }); 
	            	    dialogRef.enableButtons(false);
	                    dialogRef.setClosable(false);
	                    dialogRef.getModalBody().html('Übertragung läuft');	                    
	              }
	          }, {
	              label: 'nein',
	              action: function(dialogItself){
	                  dialogItself.close();
	              }
	          }]
	      });
		}else{
			var request = $.post("http://"+ transferObject.url +"/steve/manager/operations/v" + transferObject.ocppversion + "/" + transferObject.action,
		 	  			  {
						 	chargePointSelectList: transferObject.chargeboxid+";" + transferObject.endpointaddress, 
				  			  connectorId: transferObject.connectorid,
				  			  resetType: transferObject.resettype,
				  			  idTag: transferObject.idtag,
				  			  value: transferObject.value,
				  			  confKey:  transferObject.confKey,
				  			transactionId: transferObject.transactionid,
		 	  			  },
		 	  			  function(data,status){
		 	  				 
		 	  			  });
		}
		
	});
	return request;	
	
}
/**
 * Hauptfunktion zum starteen der Datenübertragung Übertragung
 * 
 * @param obejct $obThis Übergabe des HTML Objectes für weitere Verarbeitung
 * 
 *
 * @return html Ausgabe
 */

function getStartParameter(obThis){
	var transferObject = new Object;
	
    transferObject.connectorid = obThis.data("connectorid");
    transferObject.idtag = obThis.data("idtag");
    transferObject.endpointaddress = obThis.data("endpointaddress");
    transferObject.chargeboxid = obThis.data("chargeboxid");
    transferObject.ocppversion = obThis.data("ocppversion");
    transferObject.action = obThis.data("action");
    transferObject.resettype = obThis.data("resettype");
    transferObject.transactionid = obThis.data("transactionid");
    transferObject.url = global_url;
    transferObject.username = global_username_steve;
    transferObject.password = global_password_steve;    
    
	if (transferObject.action=="RemoteStartTransaction"){
	  		sendtoChargebox(transferObject, "Ladevorgang starten", "Wollen sie wirklich den Ladevorgang wirklich mit der RFID <b>" + transferObject.idtag + "</b> starten?");
  	}
	if (transferObject.action=="RemoteStopTransaction"){
  		sendtoChargebox(transferObject, "Ladevorgang beenden", "Wollen sie Ladevorgang wirklich beenden?");
	}
	
	if (transferObject.action=="UnlockConnector"){
  		sendtoChargebox(transferObject, "Stecker entriegeln", "Wollen sie den Stecker wirklich entriegeln?");
	}
	
	if (transferObject.action=="Reset" && transferObject.resettype=="HARD"){
		sendtoChargebox(transferObject, 'Ladestation neu starten setzen', 'Wollen sie wirklich die Ladestation neustarten?');	  		
	}
	if (transferObject.action=="Reset" && transferObject.resettype=="SOFT"){			  
	 	sendtoChargebox(transferObject, 'Zurück setzen', 'Wollen sie wirklich die Ladestation zurück setzen?');			  
	 }
	// den Hearbeat kurz setzen, damit sofort aktuallisiert und dann wieder hoch setzen!
	if (transferObject.action=="update"){
		transferObject.action = "ChangeConfiguration";
		transferObject.confKey = "HeartBeatInterval";
		transferObject.value = "5";
		sendtoChargebox(transferObject);
		
		 setTimeout(function(){
			 transferObject.value = "100";
			 sendtoChargebox(transferObject);	
			 loginSteve(transferObject).done(function() {
				 location.reload();
			 });			
         }, 5000); // 5 Sekunden warten
	 }
	
	
}