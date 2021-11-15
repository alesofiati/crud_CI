$(document).ready(function(){
	const modalDynamic = () =>{
		const modal = $(
			`<div class="modal fade" tabindex="-1" role="dialog">
					<div class="modal-dialog" role="document">
						<div class="modal-content">

						</div>
					</div>
				</div>`
		).appendTo('body')

		modal.on('hidden.bs.modal', function(){
			modal.remove()
		})
		return modal
	}

	const showMessageRedirect = (title, text, icon = 'success') =>{
		Swal.fire({
			title,
			text,
			icon,
			confirmButtonColor: '#3085d6',
			confirmButtonText: 'Okay'
		}).then((result) => {
			if (result.isConfirmed) {
				window.location.reload()
			}
		})
	}

	const validationAjax = (validation)=>{
		if(validation.errors){
			$.each(validation.errors, function(key, item){
				let msgError = $(`<span class="error-msg"> (${item})</span>`)
				let inputEl = $(`input[name='${key}'], select[name='${key}'], textarea[name='${key}']`)
				let labelEl = inputEl.closest('.form-group').find('label')
				labelEl.find('.error-msg').remove()
				labelEl.append(msgError)
				inputEl.on('focus', function(){
					inputEl.removeClass('is-invalid')
					msgError.remove()
				})
			})
		}
	}

	const defaultReturnAjax = (response) => {
		switch (response.type) {
			case "success":
				showMessageRedirect('Atenção', response.message)
				return
			break
			case "error":
				showMessageRedirect('Atenção', response.message, 'warning')
				return
			break
			case "form_error":
				validationAjax(response)
				return
			break
		}
	}

	const formAjax = () =>{
		$("#form-ajax").on("submit", function(e){
			e.preventDefault()
			const formEl = $(e.target)
			const data = formEl.serialize()
			$.ajax({
				'method': formEl.attr('method'),
				'url': formEl.attr('action'),
				data,
				dataType:'json'
			}).done((response) =>{
				defaultReturnAjax(response)
			})
		})
	}

	$(".ajax-modal").on("click", function (e){
		e.preventDefault()
		let modal = modalDynamic()
		$.get($(this).attr('href')).done(function(data){
			modal.find('.modal-content').html(data)
			modal.modal('show')
			formAjax()
		})
	})

	$(".ajax-delete").on("click", function(e){
		e.preventDefault()
		Swal.fire({
			title: 'Deseja remover esse registro?',
			text: "Esta ação não é reversiva!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#3085d6',
			confirmButtonText: 'Remover'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type:"DELETE",
					url:$(this).attr('href'),
					success: function(response){
						defaultReturnAjax(response)
					}
				})
			}
		})
	})

	$(".ajax-restore").on("click", function(e){
		e.preventDefault()
		Swal.fire({
			title: 'Deseja restaura esse registro?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			confirmButtonText: 'Restaurar'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type:"DELETE",
					url:$(this).attr('href'),
					success: function(response){
						defaultReturnAjax(response)
					}
				})
			}
		})
	})

});
