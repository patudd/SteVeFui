function loginSteve(transferObject){
	    	$.ajax({
	    	    url:"http://{{ global.url }}/steve/manager/operations/v" + transferObject.ocppversion + "/" + transferObject.action,
	    	    type:'HEAD',
	    	    error: function()
	    	    {
	    	        // wenn nicht dann anmeldung!
	    	    	 $.post("http://{{ global.url }}/steve/manager/signin",
	   	  	  			  {
	   	  	  				username: "{{ global.username_steve }}",
	   	  	  				password: "{{ global.passwort_steve }}"
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
	    	});
	    }
	    function sendtoChargebox(title, message, transferObject){
	    	
	    	loginSteve(transferObject); // wenn im SteVe nicht angemeldet!
	    	// nur bei Fehlern
	    	// connector.connectorid ? connector.connectorid : "",
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
		            	  $.post("http://{{ global.url }}/steve/manager/operations/v" + transferObject.ocppversion + "/" + transferObject.action,
				  	  			  {
					  	  			  chargePointSelectList: transferObject.chargeboxid+";" + transferObject.endpointaddress, 
					  	  			  connectorId: transferObject.connectorid,
					  	  			  resetType: transferObject.resettype,
					  	  			  idTag: transferObject.idtag 	 
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
				  				              }
				  	  	                  }]
				  		  		        });	  	  			    
				  	  			  }); 
		            	    dialogRef.enableButtons(false);
		                    dialogRef.setClosable(false);
		                    dialogRef.getModalBody().html('Übertragung läuft');
		                    setTimeout(function(){
		                        dialogRef.close();
		                        
		                    }, 5000);
		              }
		          }, {
		              label: 'nein',
		              action: function(dialogItself){
		                  dialogItself.close();
		              }
		          }]
		      });
	    	