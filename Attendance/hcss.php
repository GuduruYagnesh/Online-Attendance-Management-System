<html>
    <head>
        <style>
            #app {
            // opacity: 0 !important;
            // visibility: hidden;
            z-index: 100;
            }

            #app {
            display: grid;
            grid:50% / auto auto auto;
            grid-template-columns: 1fr 2fr;
            align-items: center;
            height: 50vh;
            width: 100%;
            background: white;
            color: #3a3535;
            }

            @import url("https://fonts.googleapis.com/css2?family=Prata&display=swap");

            .title {
            padding-left: 1em;
            grid-column: 1 / 2;
            grid-row: 1;

            font-family: "Prata", serif;
            font-size: 60px;
            width: 100%;
            z-index: 2;

            // start

            > .title-inner {
                display: inline-block;
            }
            }

            @keyframes text-clip {
            from {
                clip-path: polygon(0% 100%, 100% 100%, 100% 100%, 0% 100%);
            }
            to {
                clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
            }
            }

            @keyframes outer-left {
            from {
                transform: translateX(50%);
            }
            to {
                transform: none;
            }
            }

            @keyframes inner-left {
            from {
                transform: translateX(-50%);
            }
            to {
                transform: none;
            }
            }

            .cafe,
            .mozart {
            animation: outer-left 1s 1s cubic-bezier(0.5, 0, 0.1, 1) both;
            // outline: 1px solid red;
            }

            // [class*='inner'] {
            //   outline: 1px solid blue;
            // }

            .title-inner {
            display: inline-block;
            animation: inner-left 1s 1s ease both;
            }

            .cafe-inner {
            display: inline-block;
            animation: inner-left 1s 1s ease both,
                text-clip 1s 0s cubic-bezier(0.5, 0, 0.1, 1) both;
            }

            .mozart-inner {
            animation: text-clip 2s 0s cubic-bezier(0.5, 0, 0.1, 1) both;
            }

            .title {
            animation: outer-left 1s 1s ease both;
            }

            .cafe {
            // start
            > .cafe-inner {
                display: inline-block;
            }
            }

            .mozart {
            display: inline-block;
            }
            // Replay animation!
            body:active * {
            animation: none !important;
            }
        </style>
    </head>
</html>