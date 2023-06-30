<form action="" method="post">
<!-- The Modal -->
<div class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal body -->
            <buttton style="position:absolute;top:10px;right:10px;cursor:pointer" class="btn-close" data-bs-dismiss="modal"></buttton>
         
            <div class="modal-body text-center">
                <div class=" text-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#e6a100" width="100" height="100"  viewBox="0 0 24 24" fill-rule="evenodd" clip-rule="evenodd"><path d="M23.621 9.012c.247.959.379 1.964.379 3 0 6.623-5.377 11.988-12 11.988s-12-5.365-12-11.988c0-6.623 5.377-12 12-12 2.581 0 4.969.822 6.927 2.211l1.718-2.223 1.935 6.012h-6.58l1.703-2.204c-1.62-1.128-3.582-1.796-5.703-1.796-5.52 0-10 4.481-10 10 0 5.52 4.48 10 10 10 5.519 0 10-4.48 10-10 0-1.045-.161-2.053-.458-3h2.079zm-7.621 7.988h-8v-6h1v-2c0-1.656 1.344-3 3-3s3 1.344 3 3v2h1v6zm-5-8v2h2v-2c0-.552-.448-1-1-1s-1 .448-1 1z"/></svg>
                </div>
                <div class="text-left mb-4">
                    <p class="text-left" style="text-align:left;">
                        Para recuperar la contraseña es necesario estar registrado. Introduce tu <b>nombre de usuario</b> y <b>email</b> para restablecer la clave de acceso.
                    </p>
                </div>
                <div style="position:relative;width:100%;">
                    <div class="g-sign-in-button shadow origengbuton" onclick="jQuery('#username-rec').focus();">
                        <div class="content-wrapper">
                            <div class="logo-wrapper-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                                    <path
                                        d="M20.822 18.096c-3.439-.794-6.64-1.49-5.09-4.418 4.72-8.912 1.251-13.678-3.732-13.678-5.082 0-8.464 4.949-3.732 13.678 1.597 2.945-1.725 3.641-5.09 4.418-3.073.71-3.188 2.236-3.178 4.904l.004 1h23.99l.004-.969c.012-2.688-.092-4.222-3.176-4.935z" />
                                </svg>
                            </div>
                            <span class="text-container-2">
                                <span>
                                    <input type="text" name="username" value="&nbsp;" id=username-rec class="form-control"
                                        placeholder="Nombre de usuario" required>
                                </span>
                            </span>
                            <label for="username" class="sr-only d-none" style="opacity:0;position:absolute">username</label>
                        </div>
                    </div>
                </div>
                <div style="position:relative;width:100%;">
                    <div class="g-sign-in-button shadow origengbuton" onclick="jQuery('#email-recuperar').focus();">
                        <div class="content-wrapper">
                            <div class="logo-wrapper-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                                    <path
                                        d="M13.718 10.528c0 .792-.268 1.829-.684 2.642-1.009 1.98-3.063 1.967-3.063-.14 0-.786.27-1.799.687-2.58 1.021-1.925 3.06-1.624 3.06.078zm10.282 1.472c0 6.627-5.373 12-12 12s-12-5.373-12-12 5.373-12 12-12 12 5.373 12 12zm-5-1.194c0-3.246-2.631-5.601-6.256-5.601-4.967 0-7.744 3.149-7.744 7.073 0 3.672 2.467 6.517 7.024 6.517 2.52 0 4.124-.726 5.122-1.288l-.687-.991c-1.022.593-2.251 1.136-4.256 1.136-3.429 0-5.733-2.199-5.733-5.473 0-5.714 6.401-6.758 9.214-5.071 2.624 1.642 2.524 5.578.582 7.083-1.034.826-2.199.799-1.821-.756 0 0 1.212-4.489 1.354-4.975h-1.364l-.271.952c-.278-.785-.943-1.295-1.911-1.295-2.018 0-3.722 2.19-3.722 4.783 0 1.73.913 2.804 2.38 2.804 1.283 0 1.95-.726 2.364-1.373-.3 2.898 5.725 1.557 5.725-3.525z" />
                                </svg>
                            </div>
                            <span class="text-container-2">
                                <span>
                                    <input type="email" name="email" value="&nbsp;" id="email-recuperar" class="form-control"
                                        placeholder="Email" required>
                                </span>
                            </span>
                            <label for="email" class="sr-only d-none" style="opacity:0;position:absolute">email</label>
                        </div>
                    </div>
                </div>
                <button type="button" class="mt-3 btn btn-xs btn-small btn-sm">Recuperar contraseña</button>
            </div>
        </div>
    </div>
</div>
</form>